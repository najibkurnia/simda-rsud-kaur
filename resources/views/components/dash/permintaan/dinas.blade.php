@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Dinas</h5>
            <div class="card-footer">
                <div>
                    @if (!$recapDinas->isEmpty())
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('export-pdf-dinas') }}" method="POST">
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
                            <th>Pangkat</th>
                            <th>Jabatan</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Surat Izin</th>
                            <th>Surat Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recapDinas as $recap)
                            <tr>
                                <td>{{ $recap->user->nip }}</td>
                                <td>{{ $recap->user->nama }}</td>
                                <td>{{ $recap->user->pangkat->nama_pangkat }}</td>
                                <td>{{ $recap->user->jabatan->nama_jabatan }}</td>
                                <td>{{ $recap->tanggal_awal }}</td>
                                <td>{{ $recap->tanggal_akhir }}</td>
                                <td><a href="{{ asset('storage/permintaan/' . $recap->bukti) }}" target="_blank"
                                        class="text-danger">Lihat</a></td>
                                <td><a href="{{ asset('storage/lampiran/' . $recap->surat_tugas) }}" target="_blank"
                                        class="text-danger">Lihat</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
