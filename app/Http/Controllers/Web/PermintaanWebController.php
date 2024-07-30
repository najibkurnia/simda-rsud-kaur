<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Utils\ExportData;
use App\Models\Permintaan;
use App\Models\Riwayat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PermintaanWebController extends Controller
{
    protected $recapPermintaan;
    protected $recapDinas;
    protected $recapIzin;
    protected $recapCuti;
    protected $model;

    public function __construct()
    {
        $this->model = [
            'permintaan'    => new Permintaan,
            'riwayat'       => new Riwayat,
        ];
        $this->recapPermintaan = $this->model['riwayat']->where('permintaan_id', '!=', null);
        $this->recapDinas = $this->model['permintaan']->where('keperluan', 'Dinas')->where('status', 'accepted');
        $this->recapIzin = $this->model['permintaan']->where('keperluan', 'Izin')->orWhere('keperluan', 'Sakit')->where('status', 'accepted');
        $this->recapCuti = $this->model['permintaan']->where('keperluan', 'Cuti Tahunan')->orWhere('keperluan', 'Cuti Hamil')->where('status', 'accepted');
    }

    public function showPermintaan(): View
    {
        $data = [
            'title'             => 'Data Permintaan',
            'id_page'           => 'permintaan-index',
            'recapPermintaan'   => $this->recapPermintaan->get(),
        ];

        return view('components.dash.permintaan.index', $data);
    }

    public function showDataIzin(): View
    {
        $data = [
            'title'     => 'Data Izin',
            'id_page'   => 'permintaan-izin',
            'recapIzin' => $this->recapIzin->get(),
        ];
        return view('components.dash.permintaan.izin', $data);
    }

    public function showDataDinas(): View
    {
        $data = [
            'title'         => 'Data Dinas',
            'id_page'       => 'permintaan-dinas',
            'recapDinas'    => $this->recapDinas->get(),
        ];

        return view('components.dash.permintaan.dinas', $data);
    }

    public function showDataCuti(): View
    {
        $data = [
            'title'     => 'Data Cuti',
            'id_page'   => 'permintaan-cuti',
            'recapCuti' => $this->recapCuti->get(),
        ];

        return view('components.dash.permintaan.cuti', $data);
    }


    public function searchPermintaan(Request $request)
    {
        $key = $request->input('query');

        $this->recapPermintaan = Riwayat::whereHas('user', function ($query) use ($key) {
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
        })->where('keperluan', 'Izin')->orWhere('keperluan', 'Sakit')->where('status', 'accepted');
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

    public function handleAccepted($permintaan_id): RedirectResponse
    {
        $this->model['permintaan']->where('permintaan_id', $permintaan_id)->update([
            'status'    => 'accepted'
        ]);
        return back();
    }

    public function handleRejected($permintaan_id): RedirectResponse
    {
        $this->model['permintaan']->where('permintaan_id', $permintaan_id)->update([
            'status'    => 'rejected'
        ]);
        return back();
    }

    public function handleUploadAttachment($permintaan_id, Request $request): RedirectResponse
    {
        $attachmentRequest = $request->file('surat_tugas');
        $attachment = time() . '_' . $attachmentRequest->getClientOriginalName();
        Storage::putFileAs('public/lampiran', $attachmentRequest, $attachment);

        $this->model['permintaan']->where('permintaan_id', $permintaan_id)->update([
            'surat_tugas'       => $attachment
        ]);

        return back();
    }
}
