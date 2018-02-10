<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResponseTemplate;
use App\ResponseTemplateDetail;
use App\ResponseSchedule;
use App\Contact;
use App\User;

use Carbon\Carbon;

class ResponseScheduleController extends Controller
{

    public function index()
    {
        $schedules = ResponseSchedule::active()->orderBy('scheduled_date', 'asc')->get();
        return view('schedules.index', ['title' => 'Active Response Schedules','schedules' => $schedules]);
    }
    


    /**
     * When a trigger event fires, this method creates all response_schedule entries
     * @param  ResponseTemplate $template Pass in a Response Template
     * @param  Contact          $contact  Pass in a Contact Model
     * @return ResponseSchedule Returns a response schedule object for this Contact and Template.
     */
    public function create(ResponseTemplate $template, Contact $contact)
    {
        //Create the Response Schedule events
        // return $template;
        (!isset($contact->id)) ? $contact = Contact::find(1) : $contact = $contact;
        foreach ($template->details as $d) {
            $sched = new ResponseSchedule;
            $sched->user_id = $contact->id;
            $sched->scheduled_date = Carbon::now()->addDays($d->number_of_days);
            $sched->response_template_detail_id = $d->id;
            $sched->most_recent_note_id = 0;
            $sched->save();
        }

        $fullsched = ResponseSchedule::where('user_id', $contact->id)->whereHas('detail', function ($q) use ($template) {
                $q->where('response_template_details.response_template_id', $template->id);
        })->get();
        return $fullsched;
    }

    public function send(ResponseSchedule $schedule)
    {
        
        //Check for any new email/phone/in-person type types for this contact and reschedule responses based on the Note
        // return $schedule->most_recent_note_id;
        $note = $schedule->contact->notes()->where(function ($q) {
                $q->where('note_type', 'Email');
                $q->orWhere('note_type', 'Phone');
                $q->orWhere('note_type', 'In-Person');
        })->whereRaw('note_date > IFNULL((SELECT note_date FROM notes WHERE id = '.$schedule->most_recent_note_id." ),'".$schedule->created_at."')")
            ->orderBy('note_date', 'desc')
            ->first();
        
        //If a notes exists, call a reschedule of all items in this Response Template using the Note Date and log Note ID to the scheduled response.
        // return $note;
        if ($note) {
        //If a New Note exists, Reschedule Responses and Exit
            $schedules = $this->reschedule($schedule, $note);
            return $schedules;
        }
        // Else Send the scheduled response using the response detail template
        // Log a Note to Contact containing copy of the message
        // return $schedule->load('detail');
        $note = view('emails.templates.'.$schedule->detail->template_file_name, ['contact' => $schedule->contact]);
        $note_entry = $schedule->contact->notes()->create([
            'note_date' => Carbon::now(),
            'title' => 'Sent: ' . $schedule->detail->template . ": " . $schedule->detail->subject,
            'note_type' => 'Scheduled Response',
            'create_user_id' => \App\User::where('email', 'chris@ltdsailing.com')->first()->id, //@TODO: Add a Create User Id to Response Templates and use that here.
            'note' => \Purifier::clean($note)
            ]);
        // Send the email
        \Mail::send('emails.templates.'.$schedule->detail->template_file_name, ['contact' => $schedule->contact], function ($m) use ($schedule) {
            $m->to('chris@ltdsailing.com', 'Chris Rundlett')
            ->cc('tim@alltrips.com', 'Tim Bradshaw')
            ->from('info@ltdsailing.com', 'LTD Sailing')
            ->subject($schedule->detail->subject);
        });
        //Mark the Scheduled Response as SENT
        $schedule->sent_date = Carbon::now();
        $schedule->save();
        return $schedule;

        // return $note_entry->note;
    }

    public function sendWebInquiryResponse(ResponseSchedule $schedule)
    {
        \Mail::send('emails.templates.webinquiry', ['contact' => $schedule->contact], function ($m) use ($schedule) {
            $m->to('chris@ltdsailing.com', 'Chris Rundlett')
            ->cc('tim@alltrips.com', 'Tim Bradshaw')
            ->from('info@ltdsailing.com', 'LTD Sailing')
            ->subject('Thank You from LTD Sailing');
        });
        //Mark the Scheduled Response as SENT
        $schedule->sent_date = Carbon::now();
        $schedule->save();
    }

    public function reschedule($schedule, $note)
    {
            //Get all the scheduled responses that have not been sent
            $schedules = ResponseSchedule::where('user_id', $schedule->contact->id)->whereHas('detail', function ($q) use ($schedule) {
                $q->whereRaw('response_template_id = (SELECT response_template_id FROM response_template_details WHERE id = '.$schedule->response_template_detail_id.')');
            })->whereNull('sent_date')
            ->get();

            // return $schedules;
        foreach ($schedules as $s) {
            //Reschedule each note for the number of days set in the Response Template
            $s->scheduled_date = $note->note_date->addDays($s->detail->number_of_days);
            $s->most_recent_note_id = $note->id;
            $s->save();
        }
            return $schedules;
    }

    public function contact(Contact $contact)
    {
        
        $schedules = ResponseSchedule::where('user_id', $contact->id)->orderBy('sent_date', 'asc')->orderBy('scheduled_date', 'asc')->get();
        // $schedules->load('template');
        return $schedules;
    }

    public function delete(ResponseSchedule $schedule)
    {
        // return $schedule;
        $schedule->delete();
        return redirect()->back();
    }

    public function deleteAll(ResponseTemplate $template, Contact $contact)
    {
        $schedules = $this->getSchedulesbyTemplate($template, $contact)->pluck('id');
        // return explode(",",$schedules);
        ResponseSchedule::destroy($schedules->toArray());
        return redirect()->back();
    }

    public function changeStatus(ResponseTemplate $template, Contact $contact, Request $request)
    {
        $schedules = $this->getSchedulesbyTemplate($template, $contact);
        $new_schedules = ResponseSchedule::whereIn('id', $schedules->pluck('id'))->update(['status' => $request->input('status'),'status_change_user_id' => \Auth::user()->id]);
        return redirect()->back();
    }
    public function getSchedulesbyTemplate(ResponseTemplate $template, Contact $contact)
    {
        $schedules = ResponseSchedule::whereHas('detail', function ($q) use ($template) {
            $q->where('response_template_id', $template->id);
        })->where('user_id', $contact->id)->get();

        return $schedules;
    }

    public function notifyNoteTaker(ResponseSchedule $schedule)
    {
        \Mail::send(['text' => 'emails.notify_notetaker'], ['schedule' => $schedule], function ($m) use ($schedule) {
            $m->to($schedule->note->creator->email, $schedule->note->creator->fullname)
            ->from('tim@alltrips.com', 'Tim Bradshaw')
            ->cc('tim@alltrips.com', 'Tim Bradshaw')
            ->subject('Re-Scheduled Response');
        });
    }

    public function notifyPauser(ResponseSchedule $schedule)
    {
        $pauser = User::find($schedule->status_change_user_id);
        \Mail::send(['text' => 'emails.notify_pauser'], ['schedule' => $schedule,'pauser' => $pauser], function ($m) use ($schedule, $pauser) {
            $m->to($pauser->email, $pauser->fullname)
            ->from('no-reply@ltdsailing.com', 'LTD Operating System')
            ->cc('tim@alltrips.com', 'Tim Bradshaw')
            ->cc('chris@ltdsailing.com')
            ->subject('Reactivate Paused Responses?');
        });
    }
}
