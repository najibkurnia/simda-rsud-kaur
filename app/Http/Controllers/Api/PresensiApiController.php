<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utils\Rules;
use App\Models\Presensi;
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

        if (!in_array(request()->ip_address, $this->allowedIpAddress)) {
            return response()->json([
                'message'   => 'Pastikan anda terhubung dengan internet kantor'
            ], 403);
        }
    }

    public function handlePresensiMasuk(Request $request): JsonResponse
    {
        $proofRequest = $request->file('bukti_masuk');
        $proofMasuk = time() . '_' . $proofRequest->getClientOriginalName();
        Storage::putFileAs('public/presensi', $proofRequest, $proofMasuk);

        $start_masuk = Carbon::parse(Rules::use('start_masuk'));
        $end_masuk = Carbon::parse(Rules::use('end_masuk'));
        $start_pulang = Carbon::parse(Rules::use('start_pulang'));

        if (Carbon::parse($this->current_time)->gte($start_masuk) && Carbon::parse($this->current_time)->lt($start_pulang)) {
            $status = Carbon::parse($this->current_time)->gt($end_masuk) ? 'Telat' : 'Tepat Waktu';

            Presensi::create([
                'user_id'           => $request->user_id,
                'tanggal_presensi'  => $this->current_date,
                'jam_masuk'         => $this->current_time,
                'status'            => $status,
                'bukti_masuk'       => $proofMasuk,
            ]);

            return response()->json([
                'message'   => 'Berhasil melakukan presensi masuk',
            ], 201);
        }

        return response()->json([
            'message'       => 'Waktu presensi masuk tidak dapat diakses untuk sekarang. karena waktu menunjukkan jam ' . $this->current_time
        ], 403);
    }

    public function handlePresensiPulang(Request $request, $user_id): JsonResponse
    {
        $presensi = Presensi::where('user_id', $user_id)->where('tanggal_presensi', $this->current_date)->first();

        $start_pulang = Carbon::parse(Rules::use('start_pulang'));
        $masuk = Carbon::parse($presensi->jam_masuk);
        $pulang = Carbon::parse($this->current_time);
        $diff_time = $masuk->diff($pulang);

        $proofRequest = $request->file('bukti_pulang');
        $proofPulang = time() . '_' . $proofRequest->getClientOriginalName();
        Storage::putFileAs('public/presensi', $proofRequest, $proofPulang);

        if (Carbon::parse($this->current_time)->gte($start_pulang)) {
            Presensi::where('user_id', $user_id)->where('tanggal_presensi', $this->current_date)->update([
                'jam_pulang'        => $this->current_time,
                'bukti_pulang'      => $proofPulang,
                'total_waktu'       => $diff_time->h . ':' . $diff_time->i . ':' . $diff_time->s
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
