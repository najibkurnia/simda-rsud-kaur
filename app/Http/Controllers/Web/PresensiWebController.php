<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Presensi;
use App\Models\Riwayat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PresensiWebController extends Controller
{
    protected $current_date, $filterDate, $optFilterDate;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->current_date = Carbon::now()->format('d-m-Y');

        $this->optFilterDate = '!=';
        $this->filterDate = $this->current_date;
    }

    public function showPresensi()
    {
        $queryPreviousRecap = DB::table('riwayat')
            ->leftJoin('presensi', 'riwayat.presensi_id', '=', 'presensi.presensi_id')
            ->leftJoin('permintaan', 'riwayat.permintaan_id', '=', 'permintaan.permintaan_id')
            ->where('riwayat.tanggal_riwayat', $this->optFilterDate, $this->filterDate)
            ->groupBy('riwayat.tanggal_riwayat')
            ->select(
                'tanggal_riwayat',
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_masuk IS NOT NULL) as jumlah_jam_masuk'),
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_pulang IS NOT NULL) as jumlah_jam_pulang'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Dinas") as jumlah_dinas'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Izin") as jumlah_izin'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Sakit") as jumlah_sakit'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamilan") as jumlah_cuti'),
                DB::raw('(SELECT COUNT(*) FROM riwayat AS rw WHERE rw.tanggal_riwayat = riwayat.tanggal_riwayat) as jumlah_riwayat')
            )->paginate(10);


        $queryNowRecap = DB::table('riwayat')
            ->leftJoin('presensi', 'riwayat.presensi_id', '=', 'presensi.presensi_id')
            ->leftJoin('permintaan', 'riwayat.permintaan_id', '=', 'permintaan.permintaan_id')
            ->where('riwayat.tanggal_riwayat', $this->current_date)
            ->groupBy('riwayat.tanggal_riwayat')
            ->select(
                'tanggal_riwayat',
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_masuk IS NOT NULL) as jumlah_jam_masuk'),
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_pulang IS NOT NULL) as jumlah_jam_pulang'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Dinas") as jumlah_dinas'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Izin") as jumlah_izin'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Sakit") as jumlah_sakit'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamilan") as jumlah_cuti'),
                DB::raw('(SELECT COUNT(*) FROM riwayat AS rw WHERE rw.tanggal_riwayat = riwayat.tanggal_riwayat) as jumlah_riwayat')
            )->get();

        $data = [
            'title'         => 'Presensi',
            'id_page'       => 'presensi-index',
            'ttl_pegawai'   => User::where('role', 'pegawai')->count(),
            'riwayatPrev'    => $queryPreviousRecap,
            'riwayatNow'   => $queryNowRecap,
        ];

        return view('components.dash.presensi.index', $data);
    }

    public function searchPreviousRecap(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $searchDate = date('d-m-Y', strtotime($request->input('query')));

        if ($searchDate != $this->current_date) {
            $this->optFilterDate = '=';

            $this->filterDate = $searchDate;
        }


        return $this->showPresensi();
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
