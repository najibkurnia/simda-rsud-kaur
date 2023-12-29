<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    static function handlePresensi(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');

        if ($request->ip() != '' && $request->role != 'admin') {
            return response()->json([
                'message'   => 'Pastikan anda terhubung dengan internet kantor'
            ], 403);
        }

        $presensi = Presensi::create([
            'user_id'           => $request->user_id,
            'tanggal_presensi'  => date('Y-m-d', strtotime(now())),
            'jam_masuk'         => date('H:i:s', strtotime(now())),
            'jam_pulang'        => date('H:i:s', strtotime(now())),
        ]);

        return response()->json([
            'data'      => $presensi,
            'message'   => 'Berhasil melakukan presensi',
        ], 201);
    }
}
