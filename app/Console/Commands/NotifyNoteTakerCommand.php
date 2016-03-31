<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ResponseSchedule;
use Carbon\Carbon;
use App\Http\Controllers\ResponseScheduleController;

class NotifyNoteTakerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ltd:notifynotetaker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduled to check for upcoming Scheduled Responses that were rescheduled by a note and notify the note taker';

    protected $scheduler;
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
        //Get all Scheduled responses for the next 24 horus that have been rescheduled by a note.
        $tosend = ResponseSchedule::whereNull('sent_date')->whereBetween('scheduled_date',[Carbon::now(),Carbon::now()->addHours(24)])->has('note')->get();
        foreach($tosend as $s)
        {
            $this->scheduler->notifyNoteTaker($s);
            $this->info($s->scheduled_date . " - " . Carbon::now());
        }
        $this->info($tosend->count('id'));
        
    }
}
