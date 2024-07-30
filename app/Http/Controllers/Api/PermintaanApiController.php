<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Riwayat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermintaanApiController extends Controller
{
    public function handlePermintaan(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $current_date = Carbon::now()->format('d-m-Y');
        $proofRequest = $request->file('bukti');
        $proofClient = time() . '_' . $proofRequest->getClientOriginalName();
        Storage::putFileAs('public/permintaan', $proofRequest, $proofClient);

        $permintaan = new Permintaan();

        $permintaan->user_id = $request->input('user_id');
        $permintaan->keperluan = $request->input('keperluan');
        $permintaan->tanggal_awal = $request->input('tanggal_awal');
        $permintaan->tanggal_akhir = $request->input('tanggal_akhir');
        $permintaan->bukti = $proofClient;
        $permintaan->keterangan = $request->input('keterangan');
        $permintaan->status = 'pending';
        $permintaan->tanggal_permintaan = $current_date;

        $permintaan->save();

        Riwayat::create([
            'tanggal_riwayat'   => $current_date,
            'user_id'           => $request->input('user_id'),
            'permintaan_id'     => $permintaan->permintaan_id,
        ]);

        $user = User::where('user_id', $request->input('user_id'))->first();
        if ($request->input('keperluan') == 'Dinas') {
            $user->total_dinas++;
        } else if ($request->input('keperluan') == 'Izin') {
            $user->total_izin++;
        } else if ($request->input('keperluan') == 'Sakit') {
            $user->total_sakit++;
        } else if ($request->input('keperluan') == 'Cuti Tahunan' || $request->input('keperluan') == 'Cuti Hamil') {
            $user->total_cuti++;
        }

        $user->save();

        return response()->json([
            'data'      => $permintaan,
            'message'   => 'Berhasil membuat permintaan ' . $request->keperluan,
        ], 201);
    }
}
