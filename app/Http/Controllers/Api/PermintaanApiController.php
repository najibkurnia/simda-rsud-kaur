<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermintaanApiController extends Controller
{
    public function handlePermintaan(Request $request): JsonResponse
    {
        $proofRequest = $request->file('bukti');
        $proofClient = time() . '_' . $proofRequest->getClientOriginalName();
        Storage::putFileAs('public/permintaan', $proofRequest, $proofClient);

        $permintaan = Permintaan::create([
            'user_id'           => $request->input('user_id'),
            'keperluan'         => $request->input('keperluan'),
            'tanggal_awal'      => $request->input('tanggal_awal'),
            'tanggal_akhir'     => $request->input('tanggal_akhir'),
            'bukti'             => $proofClient,
            'keterangan'        => $request->input('keterangan'),
            'status'            => $request->input('status')
        ]);
        return response()->json([
            'data'      => $permintaan,
            'message'   => 'Berhasil membuat permintaan ' . $request->keperluan,
        ], 201);
    }
}
