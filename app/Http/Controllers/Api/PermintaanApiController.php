<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermintaanApiController extends Controller
{
    public function handlePermintaan(Request $request): JsonResponse
    {
        $permintaan = Permintaan::create([
            'user_id'           => $request->user_id,
            'jenis_permintaan'  => $request->jenis_permintaan,
            'keperluan'         => $request->keperluan,
            'tanggal_awal'      => $request->tanggal_awal,
            'tanggal_akhir'     => $request->tanggal_akhir,
            'keterangan'        => $request->keterangan,
            'surat_dinas'       => $request->surat_dinas,
            'bukti_izin'        => $request->bukti_izin,
            'status'            => $request->status
        ]);
        return response()->json([
            'data'      => $permintaan,
            'message'   => 'Berhasil membuat permintaan'
        ], 201);
    }
}
