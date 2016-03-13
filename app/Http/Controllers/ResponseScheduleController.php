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
            $sched->scheduled_date = Carbon::now()->addDays($d->number_of_days + 1);
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
        
        //Check for any new email/phone type types for this contact
        //@TODO: Setup Notes so we can check them!
        
        //If a notes exists, call a reschedule of all items in this Response Template using the Note Date
        
        // Else Send the scheduled response using the response detail template
        \Mail::send(['text' => 'emails.templates.test'],['contact' => $schedule->contact], function($m) use ($schedule) {
            $m->to('tim@alltrips.com','Tim Bradshaw')
            ->from('info@ltdsailing', 'LTD Sailing')
            ->subject('Welcome to LTD Sailing');
        });
    }

    public function contact(Contact $contact)
    {
        $schedules = ResponseSchedule::where('user_id',$contact->id)->get();
        // $schedules->load('template');
        return $schedules;
    }
   
}
