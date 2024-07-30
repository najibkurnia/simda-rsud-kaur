@extends('core.app')

@section('components')
    <div class="col hrini">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white">Absensi Hari Ini</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">Pegawai</th>
                                <th style="text-align: center">Masuk</th>
                                <th style="text-align: center">Pulang</th>
                                <th style="text-align: center">Dinas</th>
                                <th style="text-align: center">Izin</th>
                                <th style="text-align: center">Sakit</th>
                                <th style="text-align: center">Cuti</th>
                                <th style="text-align: center">Total</th>
                                <th style="text-align: center">Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($riwayatNow as $rn)
                                <tr>
                                    <td style="text-align: center">{{ $ttl_pegawai }}</td>
                                    <td style="text-align: center">{{ $rn->jumlah_jam_masuk }}</td>
                                    <td style="text-align: center">{{ $rn->jumlah_jam_pulang }}</td>
                                    <td style="text-align: center">{{ $rn->jumlah_dinas }}</td>
                                    <td style="text-align: center">{{ $rn->jumlah_izin }}</td>
                                    <td style="text-align: center">{{ $rn->jumlah_sakit }}</td>
                                    <td style="text-align: center">{{ $rn->jumlah_cuti }}</td>
                                    <td style="text-align: center">
                                        {{ $rn->jumlah_jam_masuk + $rn->jumlah_dinas + $rn->jumlah_izin + $rn->jumlah_sakit + $rn->jumlah_cuti }}</td>
                                    <td style="text-align: center">
                                        <a href="{{ route('detail-presensi', $rn->tanggal_riwayat) }}"
                                            class="btn btn-primary cstm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white">Riwayat Absensi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data1" class="table table-striped table-hover" style="width:100%">
                        <thead>
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
                        <tbody>
                            @foreach ($riwayatPrev as $rp)
                                <tr>
                                    <td>{{ $rp->tanggal_riwayat }}</td>
                                    <td style="text-align: center">{{ $ttl_pegawai }}</td>
                                    <td style="text-align: center">{{ $rp->jumlah_jam_masuk }}</td>
                                    <td style="text-align: center">{{ $rp->jumlah_jam_pulang }}</td>
                                    <td style="text-align: center">{{ $rp->jumlah_dinas }}</td>
                                    <td style="text-align: center">{{ $rp->jumlah_izin }}</td>
                                    <td style="text-align: center">{{ $rp->jumlah_sakit }}</td>
                                    <td style="text-align: center">{{ $rp->jumlah_cuti }}</td>
                                    <td style="text-align: center">
                                        {{ $rp->jumlah_jam_masuk + $rp->jumlah_dinas + $rp->jumlah_izin + $rp->jumlah_sakit + $rp->jumlah_cuti }}</td>
                                    <td>
                                        <a href="{{ route('detail-presensi', $rp->riwayat_id) }}"
                                            class="btn btn-primary cstm">Detail</a>
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
