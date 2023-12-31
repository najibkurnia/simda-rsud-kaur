<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Utils\ApiCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PegawaiWebController extends Controller
{
    protected $apiData;
    public function __construct()
    {
        $this->apiData = ApiCollection::endpoint();
    }

    public function showPegawai(): View
    {
        $data = [
            'title'     => 'Data PNS',
            'id_page'   => 'pegawai-index',
            'pegawai'   => User::where('role', 'pegawai')->get(),
        ];

        return view('components.dash.pegawai.index', $data);
    }

    public function handleTambahPegawai(Request $request)
    {
        try {
            User::create([
                'nip'           => $request->input('nip'),
                'nama'          => $request->input('nama'),
                'pangkat_id'    => $request->input('pangkat_id'),
                'golongan_id'   => $request->input('golongan_id'),
                'jabatan_id'    => $request->input('jabatan_id'),
                'no_telepon'    => $request->input('no_telepon'),
                'role'          => 'pegawai',
                'password'      => Hash::make($request->input('password')),
            ]);

            return back();
        } catch (\JsonException $e) {
            return back();
        }
    }
}
