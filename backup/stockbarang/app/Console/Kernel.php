<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Model\DataWA;
use App\Model\NotifikasiWA;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Masukkan Kode Anda Disini
        $schedule->call(function () {

            $datawa = DataWA::where('notifwa_status','Pending')->get();

            foreach ($datawa as $list) {
                $query = NotifikasiWA::api_notif_wa($list->notifwa_nohp, $list->notifwa_pesan);

                if($query == 'Berhasil') {
                    $db_wa = DataWA::find($list->notifwa_id);
                    $db_wa->notifwa_status = 'Terima';
                    $db_wa->update();
                } else {
                    $db_wa = DataWA::find($list->notifwa_id);
                    $db_wa->notifwa_status = 'Gagal';
                    $db_wa->update();
                }
            }
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
