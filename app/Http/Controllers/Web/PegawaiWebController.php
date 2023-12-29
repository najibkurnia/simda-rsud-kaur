<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PegawaiWebController extends Controller
{
    public function showPegawai(): View
    {
        $data = [
            'title'     => 'Data PNS',
            'id_page'   => 'pegawai-index',
        ];

        return view('components.dash.pegawai.index', $data);
    }
}
