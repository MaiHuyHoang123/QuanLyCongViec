<?php

namespace App\Console;

use App\Notification;
use App\Remind;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $currentTimestamp = Carbon::now('Asia/Ho_Chi_Minh');
            $reminds = Remind::all();
            foreach($reminds as $remind){
                switch($remind->period_remind){
                    case 'per week':
                        $numberDays = $currentTimestamp->diffInDays($remind->remind_date);
                        if($numberDays % 7 === 0){
                            Notification::create(['name' => $remind->name,'description' => $remind->description,'date_notify' => $remind->remind_date,'staff_id' => $remind->staff_id]);
                        }
                        break;

                    case 'per month':
                        $numberMonths = $currentTimestamp->diffInMonths($remind->remind_date);
                        if(is_int($numberMonths)){
                            Notification::create(['name' => $remind->name,'description' => $remind->description,'date_notify' => $remind->remind_date,'staff_id' => $remind->staff_id]);
                        }
                        break;

                    case 'per 6 month':
                        $numberMonths = $currentTimestamp->diffInMonths($remind->remind_date);
                        if($numberMonths % 6 == 0){
                            Notification::create(['name' => $remind->name,'description' => $remind->description,'date_notify' => $remind->remind_date,'staff_id' => $remind->staff_id]);
                        }
                        break;
                    
                    case 'per year':
                        $numberYears = $currentTimestamp->diffInYears($remind->remind_date);
                        if(is_int($numberYears)){
                            Notification::create(['name' => $remind->name,'description' => $remind->description,'date_notify' => $remind->remind_date,'staff_id' => $remind->staff_id]);
                        }
                        break;
                    
                    default:
                        Notification::create(['name' => $remind->name,'description' => $remind->description,'date_notify' => $remind->remind_date,'staff_id' => $remind->staff_id]);
                        break;
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
