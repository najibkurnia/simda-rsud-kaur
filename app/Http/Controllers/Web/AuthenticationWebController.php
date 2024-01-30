<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticationWebController extends Controller
{
    public function showLogin(): View
    {
        $data = [
            'title'     => 'Login Sistem Informasi Manajemen Data Presensi',
            'id_page'   => 'auth-index',
        ];
        return view('components.auth.index', $data);
    }

    public function handleLogin(Request $request): RedirectResponse
    {
        $credentials = $this->validate($request, [
            'nip'       => 'required|numeric',
            'password'  => 'required'
        ]);

        if (Auth::attempt($credentials, ['role' => 'admin'])) {
            return redirect()->route('presensi');
        }

        return back()->with('error', 'Maaf, akun anda tidak ditemukan!');
    }
}
