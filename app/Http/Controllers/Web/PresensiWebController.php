<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PresensiWebController extends Controller
{

    public function showPresensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $current_date = Carbon::now()->format('d-m-Y');

        $queryPreviousRecap = DB::table('presensi')
            ->leftJoin('permintaan', function ($join) {
                $join->on('presensi.tanggal_presensi', '=', 'permintaan.tanggal_permintaan');
            })
            ->where('presensi.tanggal_presensi', '!=', $current_date)
            ->groupBy('presensi.tanggal_presensi', 'permintaan.tanggal_permintaan')
            ->select(
                'presensi.tanggal_presensi',
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = presensi.tanggal_presensi AND p.jam_masuk IS NOT NULL) as jumlah_jam_masuk'),
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = presensi.tanggal_presensi AND p.jam_pulang IS NOT NULL) as jumlah_jam_pulang'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Dinas") as jumlah_dinas'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Izin") as jumlah_izin'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Sakit") as jumlah_sakit'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamilan") as jumlah_cuti'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan) as total_permintaan'),
                DB::raw('(SELECT COUNT(*) FROM presensi WHERE presensi.tanggal_presensi = presensi.tanggal_presensi) as total_presensi'),
            )->get();

        $queryNowRecap = DB::table('presensi')
            ->leftJoin('permintaan', function ($join) {
                $join->on('presensi.tanggal_presensi', '=', 'permintaan.tanggal_permintaan')
                    ->where('permintaan.tanggal_permintaan', '=', DB::raw('CURDATE()'));
            })
            ->where('presensi.tanggal_presensi', $current_date)
            ->orWhere('permintaan.tanggal_permintaan', $current_date)
            ->groupBy('presensi.tanggal_presensi', 'permintaan.tanggal_permintaan')
            ->select(
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = presensi.tanggal_presensi AND p.jam_masuk IS NOT NULL) as jumlah_jam_masuk'),
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = presensi.tanggal_presensi AND p.jam_pulang IS NOT NULL) as jumlah_jam_pulang'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Dinas") as jumlah_dinas'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Izin") as jumlah_izin'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND pr.keperluan = "Sakit") as jumlah_sakit'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = permintaan.tanggal_permintaan AND (pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamilan")) as jumlah_cuti'),
                DB::raw('COUNT(DISTINCT permintaan.tanggal_permintaan) as total_permintaan'),
                DB::raw('COUNT(DISTINCT presensi.tanggal_presensi) as total_presensi')
            )
            ->get();


        $data = [
            'title'         => 'Presensi',
            'id_page'       => 'presensi-index',
            'ttl_pegawai'   => User::where('role', 'pegawai')->count(),
            'previousRecap' => $queryPreviousRecap,
            'nowRecap'      => $queryNowRecap,
        ];

        return view('components.dash.presensi.index', $data);
        // dd($current_date);
    }

    public function showRekapPresensi(): View
    {
        $data = [
            'title'     => 'Data Presensi Bulanan',
            'id_page'   => 'presensi-rekap',
        ];

        return view('components.dash.presensi.rekap', $data);
    }
}
