<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationApiController extends Controller
{

    static function getToken($data)
    {
        $token = $data != null ? $data->createToken('auth_token')->plainTextToken : null;
        return $token;
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nip'           => 'required',
            'password'      => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Mohon maaf, NIP dan Password tidak boleh kosong!'
            ], 400);
        }

        if (Auth::attempt($request->only('nip', 'password'))) {
            if (Auth::user()->role == 'pegawai') {
                $user = User::where('nip', $request->input('nip'))->firstOrFail();

                $token = $this->getToken($user);

                return response()->json([
                    'message'       =>  'Berhasil login',
                    'token'         => $token,
                    'token_type'    => 'Bearer',
                    'data'          => $user
                ], 200);
            } else {
                return response()->json([
                    'message'       => 'Maaf, akun admin tidak ada akses di aplikasi mobile. Silakan login di web.'
                ], 401);
            }
        }

        return response()->json([
            'message'  => 'Mohon maaf, silahkan periksa NIP dan Password anda!'
        ], 401);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        $this->getToken(null);
        return response()->json([
            'message'   => 'Anda telah keluar dari sesi!'
        ], 200);
    }
}
