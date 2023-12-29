<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
