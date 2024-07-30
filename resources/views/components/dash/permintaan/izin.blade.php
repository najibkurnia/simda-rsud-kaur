@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Izin</h5>
            <div class="card-footer">
                <div>
                    @if (!$recapIzin->isEmpty())
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('export-pdf-izin') }}" method="POST">
                                @csrf
                                <button formtarget="_blank" type="submit" class="btn btn-danger text-light cstm">Cetak
                                    PDF</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recapIzin as $recap)
                            <tr>
                                <td>{{ $recap->user->nip }}</td>
                                <td>{{ $recap->user->nama }}</td>
                                <td>{{ $recap->user->jabatan->nama_jabatan }}</td>
                                <td>{{ $recap->tanggal_awal }}</td>
                                <td>{{ $recap->tanggal_akhir }}</td>
                                <td>{{ $recap->keperluan }}</td>
                                <td><a href="{{ $recap->bukti }}" class="text-danger">Lihat</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
