<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Utils\SearchData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PegawaiWebController extends Controller
{
    protected $dataPegawai;

    public function __construct()
    {
        $this->dataPegawai = User::where('role', 'pegawai');
    }

    public function showPegawai(): View
    {
        $data = [
            'title'     => 'Data PNS',
            'id_page'   => 'pegawai-index',
            'pegawai'   => $this->dataPegawai->get(),
        ];

        return view('components.dash.pegawai.index', $data);
    }

    public function searchPegawai(Request $request)
    {
        $table = new User();
        $field = 'nip';
        $searchKey = $request->input('key');
        $this->dataPegawai = SearchData::find($table, $searchKey, $field);
        return $this->showPegawai();
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
            'role'          => $request->input('role'),
            'password'      => Hash::make($request->input('password')),
        ];

        return $pegawai;
    }

    public function handleCreatePegawai(Request $request)
    {
        User::create([$this->fieldUser($request)]);
        return back();
    }

    public function handleUpdatePegawai(Request $request, $user_id)
    {
        $this->dataPegawai = $this->dataPegawai->where('user_id', $user_id)->first();

        $userData = $this->fieldUser($request);

        User::where('id', $user_id)->update($userData);

        return back();
    }
}
