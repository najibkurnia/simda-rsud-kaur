<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utils\Rules;
use App\Models\Presensi;
use App\Models\Riwayat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresensiApiController extends Controller
{
    protected $current_time, $current_date;
    protected $allowedIpAddress;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->current_time = Carbon::now()->format('H:i:s');
        $this->current_date = Carbon::now()->format('d-m-Y');
        $this->allowedIpAddress = ['192.168.0.1'];
    }

    public function handlePresensiMasuk(Request $request): JsonResponse
    {
        // if (!in_array(request()->ip_address, $this->allowedIpAddress)) {
        //     return response()->json([
        //         'message'   => 'Pastikan anda terhubung dengan internet kantor'
        //     ], 403);
        // }

        date_default_timezone_set('Asia/Jakarta');

        $proofRequest = $request->file('bukti_masuk');
        $proofMasuk = time() . '_' . $proofRequest->getClientOriginalName();
        Storage::putFileAs('public/presensi', $proofRequest, $proofMasuk);

        $start_masuk = Rules::use('start_masuk');
        $end_masuk = Rules::use('end_masuk');
        $start_pulang = Rules::use('start_pulang');

        $validationUser = Presensi::where('user_id', $request->input('user_id'))->where('tanggal_presensi', $this->current_date)->first();

        if (!$validationUser) {
            if ($this->current_time >= $start_masuk && $this->current_time < $start_pulang) {
                $status = $this->current_time > $end_masuk ? 'Telat' : 'Tepat Waktu';

                $presensi = new Presensi();

                $presensi->user_id = $request->input('user_id');
                $presensi->tanggal_presensi = $this->current_date;
                $presensi->jam_masuk = $this->current_time;
                $presensi->status = $status;
                $presensi->bukti_masuk = $proofMasuk;

                $presensi->save();

                Riwayat::create([
                    'tanggal_riwayat'   => $this->current_date,
                    'user_id'           => $request->input('user_id'),
                    'presensi_id'       => $presensi->presensi_id,
                ]);

                $user = User::where('user_id', $request->input('user_id'))->first();
                $user->total_hadir++;
                if ($status == 'Telat') {
                    $user->total_telat++;
                }
                $user->save();

                return response()->json([
                    'message'   => 'Berhasil melakukan presensi masuk',
                ], 201);
            } else {
                return response()->json([
                    'message'       => 'Waktu presensi masuk tidak dapat diakses untuk sekarang. karena waktu menunjukkan jam ' . $this->current_time,
                ], 403);
            }
        }

        return response()->json([
            'message'       => 'Anda sudah melakukan presensi masuk hari ini.',
        ], 400);
    }

    public function handlePresensiPulang(Request $request, $user_id): JsonResponse
    {
        // if (!in_array(request()->ip_address, $this->allowedIpAddress)) {
        //     return response()->json([
        //         'message'   => 'Pastikan anda terhubung dengan internet kantor'
        //     ], 403);
        // }

        $presensi = Presensi::where('user_id', $user_id)->where('tanggal_presensi', $this->current_date)->first();

        $start_pulang = Rules::use('start_pulang');
        $masuk = Carbon::parse($presensi->jam_masuk);
        $pulang = Carbon::parse($this->current_time);
        $diff_time = $masuk->diff($pulang);

        $proofRequest = $request->file('bukti_pulang');
        $proofPulang = time() . '_' . $proofRequest->getClientOriginalName();
        Storage::putFileAs('public/presensi', $proofRequest, $proofPulang);

        if ($this->current_time >= $start_pulang) {
            $presensi = Presensi::where('user_id', $user_id)->where('tanggal_presensi', $this->current_date)->first();
            $presensi->jam_pulang = $this->current_time;
            $presensi->bukti_pulang = $proofPulang;
            $presensi->total_waktu = $diff_time->h . ':' . $diff_time->i . ':' . $diff_time->s;

            $presensi->save();

            Riwayat::create([
                'tanggal_riwayat'   => $this->current_date,
                'user_id'           => $user_id,
                'presensi_id'       => $presensi->presensi_id
            ]);

            return response()->json([
                'message'       => 'Berhasil melakukan presensi pulang'
            ], 200);
        }

        return response()->json([
            'message'       => 'Waktu presensi pulang tidak dapat diakses untuk sekarang. karena waktu menunjukkan jam ' . $this->current_time
        ], 403);
    }
}
