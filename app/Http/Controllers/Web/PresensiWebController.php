<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Utils\ExportData;
use App\Http\Utils\Rules;
use App\Http\Utils\SearchData;
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
    protected $current_date, $filterDate, $optFilterDate, $dataRiwayatPegawai, $recaps;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->current_date = Carbon::now()->format('d-m-Y');

        $this->optFilterDate = '!=';
        $this->filterDate = $this->current_date;

        $this->dataRiwayatPegawai = Riwayat::with(['user', 'permintaan', 'presensi']);

        $this->recaps = User::where('role', 'pegawai')->get();
    }

    public function showPresensi(): View
    {
        $queryPreviousRecap = DB::table('riwayat')
            ->leftJoin('presensi', 'riwayat.presensi_id', '=', 'presensi.presensi_id')
            ->leftJoin('permintaan', 'riwayat.permintaan_id', '=', 'permintaan.permintaan_id')
            ->where('riwayat.tanggal_riwayat', $this->optFilterDate, $this->filterDate)
            ->groupBy('riwayat.tanggal_riwayat')
            ->select(
                DB::raw('MAX(riwayat.riwayat_id) as riwayat_id'),
                'tanggal_riwayat',
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_masuk IS NOT NULL) as jumlah_jam_masuk'),
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_pulang IS NOT NULL) as jumlah_jam_pulang'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND pr.keperluan = "Dinas" AND pr.status = "accepted") as jumlah_dinas'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND pr.keperluan = "Izin" AND pr.status = "accepted") as jumlah_izin'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND pr.keperluan = "Sakit" AND pr.status = "accepted") as jumlah_sakit'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND (pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamil") AND pr.status = "accepted") as jumlah_cuti'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Dinas" AND pr.status = "accepted") as jumlah_dinas'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Izin" AND pr.status = "accepted") as jumlah_izin'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Sakit" AND pr.status = "accepted") as jumlah_sakit'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamil" AND pr.status = "accepted") as jumlah_cuti'),
                DB::raw('(SELECT COUNT(*) FROM riwayat AS rw WHERE rw.tanggal_riwayat = riwayat.tanggal_riwayat AND rw.presensi_id IS NOT NULL) as jumlah_riwayat_presensi'),
                DB::raw('(SELECT COUNT(*) FROM riwayat AS rw WHERE rw.tanggal_riwayat = riwayat.tanggal_riwayat AND rw.permintaan_id IS NOT NULL AND (SELECT status FROM permintaan WHERE permintaan_id = rw.permintaan_id) = "accepted") as jumlah_riwayat_permintaan')

            )->get();

        $queryNowRecap = DB::table('riwayat')
            ->leftJoin('presensi', 'riwayat.presensi_id', '=', 'presensi.presensi_id')
            ->leftJoin('permintaan', 'riwayat.permintaan_id', '=', 'permintaan.permintaan_id')
            ->where('riwayat.tanggal_riwayat', $this->current_date)
            ->groupBy('riwayat.tanggal_riwayat')
            ->select(
                DB::raw('MAX(riwayat.riwayat_id) as riwayat_id'),
                'tanggal_riwayat',
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_masuk IS NOT NULL) as jumlah_jam_masuk'),
                DB::raw('(SELECT COUNT(*) FROM presensi AS p WHERE p.tanggal_presensi = riwayat.tanggal_riwayat AND p.jam_pulang IS NOT NULL) as jumlah_jam_pulang'),

                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Dinas" AND pr.status = "accepted") as jumlah_dinas'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Izin" AND pr.status = "accepted") as jumlah_izin'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND pr.keperluan = "Sakit" AND pr.status = "accepted") as jumlah_sakit'),
                // DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_permintaan = riwayat.tanggal_riwayat AND (pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamil") AND pr.status = "accepted") as jumlah_cuti'),

                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND pr.keperluan = "Dinas" AND pr.status = "accepted") as jumlah_dinas'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND pr.keperluan = "Izin" AND pr.status = "accepted") as jumlah_izin'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND pr.keperluan = "Sakit" AND pr.status = "accepted") as jumlah_sakit'),
                DB::raw('(SELECT COUNT(*) FROM permintaan AS pr WHERE pr.tanggal_awal <= riwayat.tanggal_riwayat AND pr.tanggal_akhir >= riwayat.tanggal_riwayat AND (pr.keperluan = "Cuti Tahunan" OR pr.keperluan = "Cuti Hamil") AND pr.status = "accepted") as jumlah_cuti'),

                DB::raw('(SELECT COUNT(*) FROM riwayat AS rw WHERE rw.tanggal_riwayat = riwayat.tanggal_riwayat AND rw.detail_presensi = "Masuk") as jumlah_riwayat_presensi'),
                DB::raw('(SELECT COUNT(*) FROM riwayat AS rw WHERE rw.tanggal_riwayat = riwayat.tanggal_riwayat AND rw.permintaan_id IS NOT NULL AND (SELECT status FROM permintaan WHERE permintaan_id = rw.permintaan_id) = "accepted") as jumlah_riwayat_permintaan')
            )->get();

        $data = [
            'title'         => 'Presensi',
            'id_page'       => 'presensi',
            'ttl_pegawai'   => User::where('role', 'pegawai')->count(),
            'riwayatPrev'    => $queryPreviousRecap,
            'riwayatNow'   => $queryNowRecap,
        ];

        // dd($queryNowRecap);
        // dd($data['riwayatNow']);

        return view('components.dash.presensi.index', $data);
    }

    public function showDetailPresensi($tanggal_riwayat)
    {
        $data = [
            'title'             => 'Detail presensi dan permintaan',
            'id_page'           => 'presensi',
            'tanggal_riwayat'   => $this->current_date,
            'riwayatUser' => $this->dataRiwayatPegawai
                ->where('tanggal_riwayat', $this->current_date)
                ->whereNotNull('detail_presensi')
                ->get(),

        ];

        return view('components.dash.presensi.detail', $data);
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
        $filterMonth = request()->input('month');
        $filterYear = request()->input('year');

        $data = [
            'title'             => 'Data Presensi Bulanan',
            'id_page'           => 'rekap-presensi',
            'recaps'            => $this->recaps,
            'countTglPresensi'  => Presensi::select(DB::raw('COUNT(DISTINCT tanggal_presensi) as count'))
                ->when($filterMonth, function ($query) use ($filterMonth, $filterYear) {
                    $query->whereMonth('tanggal_presensi', $filterMonth)
                        ->whereYear('tanggal_presensi', $filterYear);
                })
                ->first()
                ->count,
        ];

        return view('components.dash.presensi.rekap', $data);
    }

    public function searchRekapRiwayatPegawai(Request $request, $tanggal_riwayat)
    {
        $key = $request->input('query');

        $this->dataRiwayatPegawai = Riwayat::with(['user', 'permintaan', 'presensi'])
            ->whereHas('user', function ($query) use ($key) {
                $query->where('nama', 'like', '%' . $key . '%');
            });
        return $this->showDetailPresensi($tanggal_riwayat);
    }

    public function handleExportPdfRekapPegawai($tanggal_riwayat)
    {
        $attr = [
            'heading'       => 'Rekap Data Presensi & Permintaan Pegawai',
            'fileDir'       => 'pdf.rpp_pegawai',
            'data'          => $this->dataRiwayatPegawai->where('tanggal_riwayat', $tanggal_riwayat)->get(),
        ];
        return ExportData::PDF($attr);
    }

    public function showRincianPresensi($user_id, $riwayat_id)
    {
        $user = User::where('user_id', $user_id)->first();
        $presensi = Riwayat::where('user_id', $user_id)->where('riwayat_id', $riwayat_id)->first();

        $data = [
            'title'     => 'Rincian Presensi ' .  $user->nama,
            'id_page'   => 'presensi',
            'user'      => $user,
            'riwayat'  => $presensi,
            'jadwal_masuk' => Rules::use('start_masuk'),
            'jadwal_pulang' => Rules::use('start_pulang')
        ];

        return view('components.dash.presensi.rincian_presensi', $data);
    }

    public function showRincianPermintaan($user_id, $riwayat_id)
    {
        $user = User::where('user_id', $user_id)->first();
        $permintaan = Riwayat::where('user_id', $user_id)->where('riwayat_id', $riwayat_id)->first();

        $data = [
            'title'     => 'Rincian permintaan ' .  $user->nama,
            'id_page'   => 'permintaan',
            'user'      => $user,
            'riwayat'  => $permintaan,
            'jadwal_masuk' => Rules::use('start_masuk'),
            'jadwal_pulang' => Rules::use('start_pulang')
        ];

        return view('components.dash.presensi.rincian_permintaan', $data);
    }

    public function searchPegawaiRekapPresensi(Request $request)
    {
        $attr = [
            'model'     => new User,
            'field'     => is_numeric($request->input('query')) ? 'nip' : 'nama',
            'key'       => $request->input('query')
        ];

        $this->recaps = SearchData::find($attr)->where('role', 'pegawai')->get();

        return $this->showRekapPresensi();
    }

    public function handleExportPdfRekapBulanan()
    {
        $attr = [
            'heading'       => 'Rekap Data Presensi & Permintaan Bulanan Pegawai',
            'fileDir'       => 'pdf.rppb_pegawai',
            'data'          => User::where('role', 'pegawai')->get(),
            'countTglPresensi'  => Presensi::select(DB::raw('COUNT(DISTINCT tanggal_presensi) as count'))
                ->first()
                ->count,
        ];
        return ExportData::PDF($attr);
    }
}
