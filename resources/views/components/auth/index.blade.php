@extends('core.app')

@section('components')
    <div class="col-12">
        <div class="card border-primer">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>          
                    <div class="d-flex col-4">
                        <select name="" class="form-control me-lg-2" id="">
                            <option value="">Pilih Bulan</option>
                        </select>
                        <button class="btn btn-secondary">Tampilkan</button>
                    </div>
                    <div class="d-flex col-4">
                        <input type="text" name="" class="form-control me-0 me-lg-2" placeholder="Cari data presensi" id="">
                        <button class="btn btn-secondary">Search</button>
                    </div>
                </div>

                <div class="table-responsive my-4 col-12">
                    <table class="table table-striped">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                                <th>Hadir</th>
                                <th>Dinas</th>
                                <th>Cuti</th>
                                <th>Izin</th>
                                <th>T. Hadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=1; $i <= 8; $i++)
                            <tr>
                                <td>NIP</td>
                                <td>Nama</td>
                                <td>Pangkat</td>
                                <td>Jabatan</td>
                                <td>Hadir</td>
                                <td>Dinas</td>
                                <td>Cuti</td>
                                <td>Izin</td>
                                <td>T. Hadir</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection