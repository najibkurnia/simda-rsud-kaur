@extends('core.app')

@section('components')
<div class="col-12 mb-3">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Ketentuan Umum
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">  
                    <form action="{{ route('create-rule') }}" method="POST">
                    @csrf
                    <p class="mb-1">Lokasi Kantor</p>
                    <div class="d-flex justify-content-betwen mb-3" style="gap: 15px;">
                        <input type="text" class="form-control" required name="longitude" placeholder="Longitude">
                        <input type="text" class="form-control" required name="latitude" placeholder="Latitude">
                    </div>

                    <p class="mb-1">Jam Masuk & Pulang</p>
                    <div class="d-flex justify-content-betwen mb-3" style="gap: 15px;">
                        <input type="time" class="form-control" required name="start_masuk" placeholder="Jam Mulai Masuk">
                        <input type="time" class="form-control" required name="end_masuk" placeholder="Jam Akhir Masuk">
                        <input type="time" class="form-control" required name="start_pulang" placeholder="Jam Pulang">
                    </div>

                    <input type="checkbox" @if($umum->isEmpty()) required @endif value="used" name="status" id="status">
                    <label for="status">Gunakan ini untuk ketentuan umum</label>

                    <div class="mt-3">
                        <button class="btn bg-primer">Simpan</button>
                    </div>
                    </form>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped" id="data1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jam Mulai Masuk</th>
                                    <th>Jam Akhir Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($umum as $ketu)
                                <tr style="vertical-align: middle;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ketu->start_masuk }}</td>
                                    <td>{{ $ketu->end_masuk }}</td>
                                    <td>{{ $ketu->start_pulang }}</td>
                                    <td>{{ $ketu->longitude }}</td>
                                    <td>{{ $ketu->latitude }}</td>
                                    <td style="white-space: nowrap">
                                        @if ($ketu->status == 'unused')
                                        <form action="{{ route('use-rule', $ketu->rule_id) }}" method="POST" class="d-inline">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                Gunakan
                                            </button>
                                        </form>

                                        <form action="{{ route('delete-rule', $ketu->rule_id) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </form>

                                        @else

                                        <i>Digunakan</i>

                                        @endif  
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12" id="jaringan">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Ketentuan Jaringan
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    
                    <form action="{{ route('create-jaringan') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-betwen mb-3" style="gap: 15px;">
                            <input type="text" required class="form-control" name="nama_jaringan" placeholder="Nama Perangkat Jaringan">
                            <input type="text" required class="form-control" name="ip_address" placeholder="IP Address">
                        </div>
    
                        <div class="mt-3">
                            <button type="submit" class="btn bg-primer">Simpan</button>
                        </div>
                    </form>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped" id="data2">
                            <thead>
                                <tr>
                                    <th>Nama Perangkat Jaringan</th>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jaringan as $jar)
                                <tr style="vertical-align: middle;">
                                    <td>{{ $jar->nama_jaringan }}</td>
                                    <td>{{ $jar->ip_address }}</td>
                                    <td style="white-space: nowrap">
                                        <form action="{{ route('delete-jaringan', $jar->jaringan_id) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('handle-logout') }}" method="POST" class="col-12 mt-4">   
    @csrf 
    <button type="submit" class="btn btn-danger px-3 py-2">Keluar</button>
</form>

@endsection