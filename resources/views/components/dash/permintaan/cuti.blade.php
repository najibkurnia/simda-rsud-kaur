@extends('core.app')

@section('components')
    <div class="col-12">
        <div class="card border-primer">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>          
                    
                    <div class="d-flex col-4">
                        <input type="text" name="" class="form-control me-0 me-lg-2" placeholder="Cari data" id="">
                        <button class="btn btn-secondary">Search</button>
                    </div>
                </div>

                <div class="table-responsive my-4 col-12">
                    <table class="table table-striped">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Surat Izin</th>
                                <th>Surat Tugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=1; $i <= 8; $i++)
                            <tr>
                                <td>NIP</td>
                                <td>Nama</td>
                                <td>Jabatan</td>
                                <td>Mulai</td>
                                <td>Selesai</td>
                                <td>Surat Izin</td>
                                <td>Surat Tugas</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection