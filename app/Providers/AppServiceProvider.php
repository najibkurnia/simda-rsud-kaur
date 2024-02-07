<?php

namespace App\Providers;

use App\Http\Utils\Rules;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // if ($infoPresensi->isEmpty() && $current_time >= $start_pulang) {
        //     $user = User::where('user_id', auth()->user()->user_id)->first();
        //     $user->total_absen++;
        //     $user->save();
        // }

        // date_default_timezone_set('Asia/Jakarta');
        // // $current_date = date('d-m-Y', strtotime('now'));
        // $current_time = date('H:i:s', strtotime('now'));
        // $start_pulang = Rules::use('start_pulang');

        // // if ($current_time >= $start_pulang) {
        // //     $infoPresensi = Presensi::where('tanggal_presensi', $current_date)->get();
        // //     $users = User::where('role', 'pegawai')->get();

        // //     foreach ($users as $user) {
        // //         $user_id = $user->id;

        // //         $userInPresensi = $infoPresensi->where('user_id', $user_id)->first();

        // //         if ($userInPresensi) {
        // //             $user->total_absen++;
        // //             $user->save();
        // //         }
        // //     }
        // // 

        // if ($current_time == '12:11:00') {
        //     echo 'njay';
        // }
    }
}
