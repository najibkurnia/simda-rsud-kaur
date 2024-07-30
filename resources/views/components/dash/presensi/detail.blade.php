@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('presensi') }}" class="btn btn-success cstm">Kembali</a>
            <div class="d-flex justify-content-between">
                <form action="{{ route('export-pdf-rekap-pegawai', $tanggal_riwayat) }}" method="POST">
                    @csrf
                    <button formtarget="_blank" type="submit" class="btn btn-info text-light cstm">Cetak PDF</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Pangkat</th>
                            <th>Jabatan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($riwayatUser as $riwayat)
                            <tr>
                                <td>{{ $riwayat->user->nip }}</td>
                                <td>{{ $riwayat->user->nama }}</td>
                                <td>{{ $riwayat->user->pangkat->nama_pangkat }}</td>
                                <td>{{ $riwayat->user->jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($riwayat->presensi != null)
                                        <span>{{ $riwayat->detail_presensi }}</span>
                                    @else
                                        <span>{{ $riwayat->permintaan->keperluan }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $riwayat->presensi != null ? route('rincian-presensi', [$riwayat->user_id, $riwayat->riwayat_id]) : route('rincian-permintaan', [$riwayat->user_id, $riwayat->riwayat_id]) }}"
                                        class="btn btn-primary cstm">Detail</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
