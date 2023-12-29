<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PelanggaranWebController extends Controller
{
    public function showPelanggaran(): View
    {
        $data = [
            'title'     => 'Data Pelanggaran',
            'id_page'   => 'pelanggaran-index'
        ];

        return view('components.dash.pelanggaran.index', $data);
    }
}
