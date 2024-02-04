@extends('core.app')

@section('components')
    <div class="col-12 mb-5">
       <div class="card bg-card">
        <div class="card-body">
            <strong>
                <span>PRESENSI HARI INI</span>
            </strong>
            <div class="my-3">
                <button class="btn btn-secondary">Presensi</button>
            </div>

            <div class="table-responsive my-3">
                <table class="table" style="white-space: nowrap; border: 1px solid #aaa">
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th>Pegawai</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Dinas</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Cuti</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-td" style="vertical-align: middle">
                        @foreach ($nowRecap as $now)
                        <tr>
                            <td>{{ $ttl_pegawai }}</td>
                            <td>{{ $now->jumlah_jam_masuk }}</td>
                            <td>{{ $now->jumlah_jam_pulang }}</td>
                            <td>{{ $now->jumlah_dinas }}</td>
                            <td>{{ $now->jumlah_izin }}</td>
                            <td>{{ $now->jumlah_sakit }}</td>
                            <td>{{ $now->jumlah_cuti }}</td>
                            <td>{{ ($now->total_presensi + $now->total_permintaan) }}</td>
                            <td>
                                <button class="btn bg-primer">Detail</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                
                @if ($nowRecap->isEmpty())
                    <p class="text-secondary">Data presensi dan permintaan belum ada hari ini!</p>
                @endif
            </div>
        </div>
       </div>
    </div>

    <div class="col-12">
        <div class="card bg-card">
         <div class="card-body">
             <strong>
                <span>RIWAYAT PRESENSI</span>
             </strong>

             <div class="row my-3 justify-content-end">
                <div class="col-4 d-flex align-items-center" style="gap: 10px">
                    <select name="" class="form-control" required id="">
                        <option value="">Pilih Tanggal</option>
                        <option value="">lainnya</option>
                    </select>
                    <button class="btn btn-secondary">Search</button>
                </div>
             </div>

             <div class="table-responsive">
                 <table class="table table-striped" style="white-space: nowrap; border: 1px solid #aaa">
                     <thead class="bg-secondary text-light">
                         <tr>
                             <th>Tanggal</th>
                             <th>Pegawai</th>
                             <th>Masuk</th>
                             <th>Pulang</th>
                             <th>Dinas</th>
                             <th>Izin</th>
                             <th>Sakit</th>
                             <th>Cuti</th>
                             <th>Total</th>
                             <th>Detail</th>
                         </tr>
                     </thead>
 
                     <tbody class="bg-td" style="vertical-align: middle">
                        @foreach($previousRecap as $prev) 
                        <tr>
                            <td>{{ $prev->tanggal_presensi }}</td>
                            <td>{{ $ttl_pegawai }}</td>
                            <td>{{ $prev->jumlah_jam_masuk }}</td>
                            <td>{{ $prev->jumlah_jam_pulang }}</td>
                            <td>{{ $prev->jumlah_dinas }}</td>
                            <td>{{ $prev->jumlah_izin }}</td>
                            <td>{{ $prev->jumlah_sakit }}</td>
                            <td>{{ $prev->jumlah_cuti }}</td>
                            <td>{{ ($prev->total_presensi + $prev->total_permintaan) }}</td>
                            <td>
                                <button class="btn btn-secondary">Detail</button>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
        </div>
     </div>
@endsection