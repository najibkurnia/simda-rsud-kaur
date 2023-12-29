<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermintaanWebController extends Controller
{
    public function showPermintaan(): View
    {
        $data = [
            'title'     => 'Data Permintaan',
            'id_page'   => 'permintaan-index'
        ];
        return view('components.dash.permintaan.index', $data);
    }

    public function showDataIzin(): View
    {
        $data = [
            'title'     => 'Data Izin',
            'id_page'   => 'permintaan-izin'
        ];
        return view('components.dash.permintaan.izin', $data);
    }

    public function showDataDinas(): View
    {
        $data = [
            'title'     => 'Data Dinas',
            'id_page'   => 'permintaan-dinas',
        ];

        return view('components.dash.permintaan.dinas', $data);
    }

    public function showDataCuti(): View
    {
        $data = [
            'title'     => 'Data Cuti',
            'id_page'   => 'permintaan-cuti'
        ];

        return view('components.dash.permintaan.cuti', $data);
    }
}
