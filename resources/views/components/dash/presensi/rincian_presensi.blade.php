@extends('core.app')

@section('components')
<div class="col-12">
    <button onclick="history.back()" class="btn mb-3 bg-back">Kembali</button>
    
    <div class="card bg-card">
        <div class="card-body m-2">

            <h5 class="mb-4">DETAIL PRESENSI {{ $user->nama }}</h5>

            <div class="row justify-content-around align-items-center">
                <div class="col-4 p-0 border border-dark" style="height:50vh; width: 25vw">
                    <img src="{{ asset('storage/presensi/'.$presensi->bukti_masuk) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="">
                </div>
                <div class="table-responsive col-7">
                   <table class="table table-striped">
                    <thead class="bg-th">
                        <tr>
                            <th>Presensi Masuk</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="bg-td">
                        <tr>
                            <td><p>Jadwal Masuk</p></td>
                            <td><p>{{ $jadwal_masuk ?? 'N/A' }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Presensi Masuk</p></td>
                            <td><p>{{ $presensi->jam_masuk ?? 'N/A' }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Status Presensi</p></td>
                            <td><p>{{ $presensi->status }}</p></td>
                        </tr>
                    </tbody>
                   </table>
                </div>
            </div>

            <div id="pulang" class="row mt-5 justify-content-around align-items-center">
                <div class="col-4 p-0 border border-dark" style="height:50vh; width: 25vw">
                    <img src="{{ asset('storage/presensi/'.$presensi->bukti_pulang) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="">
                </div>
                <div class="table-responsive col-7">
                   <table class="table table-striped">
                    <thead class="bg-th">
                        <tr>
                            <th>Presensi Pulang</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="bg-td">
                        <tr>
                            <td><p>Jadwal Pulang</p></td>
                            <td><p>{{ $jadwal_pulang ?? 'N/A' }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Presensi Pulang</p></td>
                            <td><p>{{ $presensi->jam_pulang ?? 'N/A' }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Total Waktu</p></td>
                            <td><p>{{ $presensi->total_waktu ?? 'N/A' }}</p></td>
                        </tr>
                    </tbody>
                   </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection