<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use DB;
use Log;
use Carbon\Carbon;
class DailyOnce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'once:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refreshing matching count of employers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Log::info('Cron Job Started');

        $employers=DB::table('employers')->where('used_times', 1)->get();
        if(count($employers)>0){
            foreach($employers as $emp){
                $end_time=Carbon::now();
                $time1 = new DateTime($emp->updated_at);
                $time2 = new DateTime($end_time);
                $interval = $time1->diff($time2);
                $day = $interval->d;
                    if($day==1){
                        DB::table('employers')->where('id', $emp->id)->update(['used_times'=>0, 'updated_at'=>Carbon::now()]);
                        DB::table('filedownloads')->where('id', $emp->id)->delete();

                    }
            }
        }

        $employees=DB::table('employees')->where('matched_times', 1)->where('token', '!=', 'null')->get();
        if(count($employees)>0){
            foreach($employees as $emp1){
                $end_time=Carbon::now();
                $time1 = new DateTime($emp1->updated_at);
                $time2 = new DateTime($end_time);
                $interval = $time1->diff($time2);
                $day = $interval->d;
                    if($day==1){
                        DB::table('employees')->where('id', $emp1->id)
                        ->update(['matched_times'=>0, 'token'=>'', 'updated_at'=>Carbon::now()]);
                    }
            }
        }

        

    }
}
