<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Presensi;
use App\Models\Riwayat;
use App\Models\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataCollectionController extends Controller
{
    public function getRiwayatPresensi($user_id): JsonResponse
    {
        $riwayatPresensi = Riwayat::where('user_id', $user_id)->where('detail_presensi', '!=', null)->get();

        return response()->json([
            'data'  => $riwayatPresensi
        ], 200);
    }

    public function getRiwayatPermintaan($user_id): JsonResponse
    {
        $riwayatPermintaan = Permintaan::where('user_id', $user_id)->get();

        return response()->json([
            'data'  => $riwayatPermintaan
        ], 200);
    }
}
