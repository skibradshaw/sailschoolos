<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResponseTemplate;
use App\ResponseTemplateDetail;
use App\ResponseSchedule;
use App\Contact;

use Carbon\Carbon;

class ResponseScheduleController extends Controller
{

    public function index()
    {
        $schedules = ResponseSchedule::active()->orderBy('scheduled_date','asc')->get();
        return view('schedules.index',['title' => 'Active Response Schedules','schedules' => $schedules]);
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
        foreach($template->details as $d)
        {
            $sched = new ResponseSchedule;
            $sched->user_id = $contact->id;
            $sched->scheduled_date = Carbon::now()->addDays($d->number_of_days);
            $sched->response_template_detail_id = $d->id;
            $sched->save();
        }

        $fullsched = ResponseSchedule::where('user_id',$contact->id)->whereHas('detail',function($q) use ($template)
            {
                $q->where('response_template_details.response_template_id',$template->id);
            })->get();
        return $fullsched;
    }

    public function send(ResponseSchedule $schedule)
    {
        
        //Check for any new email/phone/in-person type types for this contact and reschedule responses based on the Note
        // return $schedule->most_recent_note_id;
        $note = $schedule->contact->notes()->where(function($q){
                $q->where('note_type','Email');
                $q->orWhere('note_type','Phone');
                $q->orWhere('note_type','In-Person');
            })->whereRaw('note_date > IFNULL((SELECT note_date FROM notes WHERE id = '.$schedule->most_recent_note_id." ),'".$schedule->created_at."')")
            ->orderBy('note_date','desc')
            ->first();
        
        //If a notes exists, call a reschedule of all items in this Response Template using the Note Date and log Note ID to the scheduled response.
        // return $note;
        if($note)
        {
            //Get all the scheduled responses that have not been sent
            $schedules = ResponseSchedule::where('user_id',$schedule->contact->id)->whereHas('detail',function($q) use ($schedule) {
                $q->whereRaw('response_template_id = (SELECT response_template_id FROM response_template_details WHERE id = '.$schedule->response_template_detail_id.')');
            })->whereNull('sent_date')
            ->get();

            // return $schedules;
            foreach($schedules as $s)
            {
                //Reschedule each note for the number of days set in the Response Template
                $s->scheduled_date = $note->note_date->addDays($s->detail->number_of_days);
                $s->most_recent_note_id = $note->id; 
                $s->save();
                
            }
            return $schedules;
        }        
        // Else Send the scheduled response using the response detail template
        // Log a Note to Contact containing copy of the message
        // return $schedule->load('detail');
        $note = view('emails.templates.test',['contact' => $schedule->contact]);
        $note_entry = $schedule->contact->notes()->create([
            'note_date' => Carbon::now(),
            'title' => 'Sent: ' . $schedule->detail->template,
            'note_type' => 'Scheduled Response',
            'create_user_id' => \App\User::where('email','chris@ltdsailing.com')->first()->id, //@TODO: Add a Create User Id to Response Templates and use that here.
            'note' => \Purifier::clean($note)
            ]);
        // Send the email
        \Mail::send(['text' => 'emails.templates.test'],['contact' => $schedule->contact], function($m) use ($schedule) {
            $m->to('chris@ltdsailing','Chris Rundlett')
            ->cc('tim@alltrips.com','Tim Bradshaw')
            ->from('info@ltdsailing', 'LTD Sailing')
            ->subject('Welcome to LTD Sailing'); //@TODO: Set the subject from the Email Template
        });
        //Mark the Scheduled Response as SENT
        $schedule->sent_date = Carbon::now();
        $schedule->save();
        return $schedule;

        // return $note_entry->note;
    }

    public function contact(Contact $contact)
    {
        
        $schedules = ResponseSchedule::where('user_id',$contact->id)->get();
        // $schedules->load('template');
        return $schedules;
    }

    public function delete(ResponseSchedule $schedule)
    {
        return $schedule;
        $schedule->delete();
        return redirect()->back();
    }
   
}
