<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PresensiWebController extends Controller
{
    public function showPresensi(): View
    {
        $data = [
            'title'     => 'Presensi',
            'id_page'   => 'presensi-index'
        ];
        return view('components.dash.presensi.index', $data);
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
