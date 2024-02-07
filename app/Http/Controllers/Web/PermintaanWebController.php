<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Utils\ExportData;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermintaanWebController extends Controller
{
    protected $recapPermintaan;
    protected $recapDinas;
    protected $recapIzin;
    protected $recapCuti;

    public function __construct()
    {
        $model = new Permintaan;
        $this->recapPermintaan = $model;
        $this->recapDinas = $model->where('keperluan', 'Dinas')->where('status', 'accepted');
        $this->recapIzin = $model->where('keperluan', 'Izin')->where('status', 'accepted');
        $this->recapCuti = $model->where('keperluan', 'Cuti Tahunan')->orWhere('keperluan', 'Cuti Hamil')->where('status', 'accepted');
    }

    public function showPermintaan(): View
    {
        $data = [
            'title'             => 'Data Permintaan',
            'id_page'           => 'permintaan-index',
            'recapPermintaan'   => $this->recapPermintaan->paginate(10)
        ];

        return view('components.dash.permintaan.index', $data);
    }

    public function showDataIzin(): View
    {
        $data = [
            'title'     => 'Data Izin',
            'id_page'   => 'permintaan-izin',
            'recapIzin' => $this->recapIzin->paginate(10)
        ];
        return view('components.dash.permintaan.izin', $data);
    }

    public function showDataDinas(): View
    {
        $data = [
            'title'         => 'Data Dinas',
            'id_page'       => 'permintaan-dinas',
            'recapDinas'    => $this->recapDinas->paginate(10),
        ];

        return view('components.dash.permintaan.dinas', $data);
    }

    public function showDataCuti(): View
    {
        $data = [
            'title'     => 'Data Cuti',
            'id_page'   => 'permintaan-cuti',
            'recapCuti' => $this->recapCuti->paginate(10),
        ];

        return view('components.dash.permintaan.cuti', $data);
    }


    public function searchPermintaan(Request $request)
    {
        $key = $request->input('query');

        $this->recapPermintaan = Permintaan::whereHas('user', function ($query) use ($key) {
            $query->where('nama', 'like', '%' . $key . '%');
        });
        return $this->showPermintaan();
    }

    public function handleExportPdfPermintaan()
    {
        $attr = [
            'heading'       => 'Data Permintaan Dinas/Cuti/Izin/Sakit Pegawai',
            'fileDir'       => 'pdf.permintaan',
            'data'          => $this->recapPermintaan->get(),
        ];

        return ExportData::PDF($attr);
    }

    public function searchDinas(Request $request)
    {
        $key = $request->input('query');

        $this->recapDinas = Permintaan::whereHas('user', function ($query) use ($key) {
            $query->where('nama', 'like', '%' . $key . '%');
        })->where('keperluan', 'Dinas')->where('status', 'accepted');
        return $this->showDataDinas();
    }

    public function handleExportPdfDinas()
    {
        $attr = [
            'heading'       => 'Data Pegawai Yang Dinas',
            'fileDir'       => 'pdf.dinas',
            'data'          => $this->recapDinas->get(),
        ];

        return ExportData::PDF($attr);
    }

    public function searchIzin(Request $request)
    {
        $key = $request->input('query');

        $this->recapIzin = Permintaan::whereHas('user', function ($query) use ($key) {
            $query->where('nama', 'like', '%' . $key . '%');
        })->where('keperluan', 'Izin')->where('status', 'accepted');
        return $this->showDataIzin();
    }

    public function handleExportPdfIzin()
    {
        $attr = [
            'heading'       => 'Data Pegawai Yang Izin',
            'fileDir'       => 'pdf.izin',
            'data'          => $this->recapIzin->get(),
        ];

        return ExportData::PDF($attr);
    }

    public function searchCuti(Request $request)
    {
        $key = $request->input('query');

        $this->recapCuti = Permintaan::whereHas('user', function ($query) use ($key) {
            $query->where('nama', 'like', '%' . $key . '%');
        })->where('keperluan', 'Cuti Tahunan')->orWhere('keperluan', 'Cuti Hamil')->where('status', 'accepted');
        return $this->showDataCuti();
    }

    public function handleExportPdfCuti()
    {
        $attr = [
            'heading'       => 'Data Pegawai Yang Cuti',
            'fileDir'       => 'pdf.cuti',
            'data'          => $this->recapCuti->get(),
        ];

        return ExportData::PDF($attr);
    }
}
