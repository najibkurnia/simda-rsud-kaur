<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Utils\ExportData;
use App\Http\Utils\SearchData;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PegawaiWebController extends Controller
{
    protected $dataPegawai, $model;

    public function __construct()
    {
        $this->model = [
            'user'      => new User,
            'pangkat'   => new Pangkat,
            'jabatan'   => new Jabatan,
            'golongan'  => new Golongan,
        ];

        $this->dataPegawai = $this->model['user']
            ->with(['pangkat', 'golongan', 'jabatan'])
            ->where('role', 'pegawai')
            ->orderBy('user_id', 'DESC')
            ->get();
    }

    public function showPegawai(): View
    {
        $data = [
            'title'     => 'Data PNS',
            'id_page'   => 'pegawai-index',
            'pegawai'   => $this->dataPegawai,
            'pangkat'   => $this->model['pangkat']->all(),
            'golongan'  => $this->model['golongan']->all(),
            'jabatan'   => $this->model['jabatan']->all(),
        ];

        return view('components.dash.pegawai.index', $data);
    }

    public function fieldUser($request)
    {
        $pegawai = [
            'nip'           => $request->input('nip'),
            'nama'          => $request->input('nama'),
            'pangkat_id'    => $request->input('pangkat_id'),
            'golongan_id'   => $request->input('golongan_id'),
            'jabatan_id'    => $request->input('jabatan_id'),
            'no_telepon'    => $request->input('no_telepon'),
            'role'          => 'pegawai',
            'alamat'        => $request->input('alamat'),
            'password'      => Hash::make($request->input('nip')),
        ];

        return $pegawai;
    }

    public function nipUniqueValidation($nip)
    {
        return $this->model['user']->where('nip', $nip)->first();
    }

    public function handleCreatePegawai(Request $request): RedirectResponse
    {
        $checkNip = $this->nipUniqueValidation($request->input('nip'));
        $userData = $this->fieldUser($request);
        if (!$checkNip) {
            $this->model['user']->create($userData);
            return back()->with('success', 'Berhasil membuat akun pegawai');
        }

        return back()->with('error', 'NIP yang dimasukkan telah terdaftar sebelumnya.');
    }

    public function handleUpdatePegawai(Request $request, $user_id): RedirectResponse
    {
        // 1. Mencari pengguna dengan ID yang diberikan
        $user = $this->model['user']->find($user_id);

        // 2. Melakukan validasi terhadap NIP yang baru dimasukkan
        $otherUser = $this->nipUniqueValidation($request->input('nip'));

        // 3. NIP baru tidak sama dengan NIP data atau NIP baru sama dengan NIP pengguna, tetap diperbarui
        if (!$otherUser || $user->nip === $request->input('nip')) {
            $userData = $this->fieldUser($request);
            $this->model['user']->where('user_id', $user_id)->update($userData);
            return back()->with('info', 'Berhasil memperbarui akun pegawai');
        }
        // 4. Jika NIP yang baru sudah ada dalam data pengguna lain, program akan memberikan pesan kesalahan
        else {
            return back()->with('error', 'NIP yang dimasukkan telah terdaftar sebelumnya');
        }

        return back();
    }


    public function handleDeletePegawai($user_id): RedirectResponse
    {
        $this->model['user']->where('user_id', $user_id)->delete();
        return back()->with('warning', 'Akun pegawai telah dihapus');
    }

    public function handleExportPdf()
    {
        $attr = [
            'heading'       => 'Rekap Data PNS',
            'fileDir'       => 'pdf.pns',
            'data'          => User::where('role', 'pegawai')->orderBy('user_id', 'DESC')->get(),
        ];
        return ExportData::PDF($attr);
    }
}
