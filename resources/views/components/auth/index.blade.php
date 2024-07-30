@extends('core.app')

@section('components')
    <!----------------------- Main Container -------------------------->
    <div class="container-fluid login-container min-vh-100">

        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-4 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->
            <div class="col rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <div class="featured-image mb-3 mt-2">
                    <img src="{{ asset('img/user.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-weight: 600;">Be
                    Verified</p>
                <small class="text-white text-wrap text-center mb-2" style="width: 10rem;">Welcome, please enter you
                    details.</small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->
            <div class="col right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-2">
                        <h2>Hello,Again</h2>
                        <p>We are happy to have you back.</p>
                    </div>
                    @auth
                        <p>Silakan logout terlebih dahulu supaya dapat melakukan login kembali!</p>

                        <form action="{{ route('handle-logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Keluar</button>
                        </form>
                    @else
                        <form action="{{ route('handle-login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip') }}" name="nip" id="nip" placeholder="Nomor Induk Pegawai">
                                @error('nip')
                                    <span class="text-danger fsmall">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Password">
                                @error('password')
                                    <span class="text-danger fsmall">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group mb-2">
                                <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
