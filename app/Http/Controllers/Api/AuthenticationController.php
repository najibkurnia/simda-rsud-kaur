<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{

    static function getToken($data)
    {
        $token = $data != null ? $data->createToken('auth_token')->plainTextToken : null;
        return $token;
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nip'           => 'required',
            'nama'          => 'required',
            'pangkat_id'    => 'required',
            'golongan_id'   => 'required',
            'jabatan_id'    => 'required',
            'no_telepon'    => 'required',
            'role'          => 'required',
            'password'      => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Ada kesalahan dalam penginputan'
            ], 400);
        }

        $user = User::create([
            'nip'           => $request->input('nip'),
            'nama'          => $request->input('nama'),
            'pangkat_id'    => $request->input('pangkat_id'),
            'golongan_id'   => $request->input('golongan_id'),
            'jabatan_id'    => $request->input('jabatan_id'),
            'no_telepon'    => $request->input('no_telepon'),
            'role'          => $request->input('required'),
            'password'      => Hash::make($request->input('password'))
        ]);

        $token = $this->getToken($user);

        return response()->json([
            'data'          => $user,
            'message'       => 'Berhasil mendaftarkan pengguna',
            'access_token'  => $token,
            'token_type'    => 'Bearer',
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {

        if (!Auth::attempt($request->only('nip', 'password'))) {
            return response()->json([
                'message'  => 'Gagal untuk login'
            ], 401);
        }

        $user = User::where('nip', $request->input('nip'))->firstOrFail();

        $token = $this->getToken($user);

        return response()->json([
            'message'       =>  'Berhasil login',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ], 200);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        $this->getToken(null);
        return response()->json([
            'message'   => 'Berhasil logout'
        ], 200);
    }
}
