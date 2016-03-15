<?php

namespace App\Listeners;

use App\Events\ScheduleResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\ResponseScheduleController;
use App\ResponseTemplate;
use App\Contact;

class ProspectInquiryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ResponseScheduleController $schedule)
    {
        //
        $this->schedule = $schedule;
    }

    /**
     * Handle the event.
     *
     * @param  ScheduleResponse  $event
     * @return void
     */
    public function handle(ScheduleResponse $event)
    {
        //
        // if(!$response_templates = ResponseTemplate::where('trigger_event',1)->orderBy('created_at','desc')->get())
        // {
        //     return false;
        // }
        $response_templates = ResponseTemplate::where('trigger_event',1)->orderBy('created_at','desc')->get();
        $contact = Contact::find($event->inquiry->user_id);
        foreach($response_templates as $t)
        {
            $this->schedule->create($t,$contact);
        }

            
        \Mail::raw('Scheduled Responses were created for ' . $contact->fullname,function($m) {
            $m->to('tim@alltrips.com','Tim Bradshaw')
            ->from('info@ltdsailing.com','LTD Sailing')
            ->subject('The Prospect Inquiry Event Handler Fired to Create Scheduled Responses');
        });
    }
}
