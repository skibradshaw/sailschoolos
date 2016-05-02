<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ResponseSchedule;
use App\Http\Controllers\ResponseScheduleController;
use Carbon\Carbon;

class NotifyResponsePauserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ltd:notifypaused';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies the User that paused a scheduled response to reactivate.';
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
        $schedules = ResponseSchedule::with('detail')->where('status','paused')->where('updated_at','<',Carbon::now()->subDays(3))->whereHas('contact.notes',function($q){
            $q->where('note_date','>',Carbon::parse('3 days ago'));
        },'<',1)->get();
        $schedules = $schedules->groupBy('detail.response_template_id');
        $i = 0;
        foreach($schedules as $k => $s)
        {
            foreach($s as $n)
            {
                if($k != $i)
                {
                   $this->scheduler->notifyPauser($n);
                   $this->info($n);
                   $i = $k; 
                }                
            }
       
        }
    }
}
