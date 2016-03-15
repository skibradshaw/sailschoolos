<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ResponseSchedule;
use Carbon\Carbon;
use App\Http\Controllers\ResponseScheduleController;

class SendScheduledResponses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ltd:sendscheduled';

    protected $scheduler;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs every 5 minutes.  Checks for Scheduled Automated Responses and triggers ResponseScheduleController@send method';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ResponseScheduleController $scheduler)
    {
        parent::__construct();
        $this->scheduler = $scheduler;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Get Scheduled Responses and call teh SEND method for any found
        $tosend = ResponseSchedule::active()->where('scheduled_date','<',Carbon::now())->get();
        foreach($tosend as $s)
        {
            // $this->scheduler->send($s);
            $this->info($s->scheduled_date . " - " . Carbon::now());
        }
        $this->info($tosend->count('id'));
        
    }
}
