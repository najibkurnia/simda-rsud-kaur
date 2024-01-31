@extends('core.app')

@section('components')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-4 px-0 col-12 px-3 px-lg-0">
            <div class="card border border-dark">
                <div class="card-header bg-primer">
                    <h4>Silakan Login</h4>
                    <p>Sistem Manajemen Data - RSUD KAUR</p>
                </div>
                <div class="card-body bg-light rounded">
                    @auth
                        <p>Silakan logout terlebih dahulu supaya dapat melakukan login kembali!</p>

                        <form action="{{ route('handle-logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Logout</button>
                        </form>
                    @else
                    <form action="{{ route('handle-login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" name="nip" id="nip" placeholder="Nomor Induk Pegawai">
                            @error('nip')
                            <span class="text-danger fsmall">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                            @error('password')
                            <span class="text-danger fsmall">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <button type="submit" class="btn bg-primer px-4 py-2">Masuk</button>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection