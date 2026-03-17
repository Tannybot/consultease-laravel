<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpireAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark appointments as expired when their schedule date has passed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = date('Y-m-d');

        $expired = DB::table('appointment')
            ->join('schedule', 'appointment.scheduleid', '=', 'schedule.scheduleid')
            ->where('schedule.scheduledate', '<', $today)
            ->whereIn('appointment.status', ['active', 'booked'])
            ->update(['appointment.status' => 'expired']);

        $this->info("Expired {$expired} past-date appointment(s).");

        return Command::SUCCESS;
    }
}
