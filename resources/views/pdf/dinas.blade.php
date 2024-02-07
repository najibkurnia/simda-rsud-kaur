@extends('pdf.index')

@section('render-pdf')
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Pangkat</th>
            <th>Jabatan</th>
            <th>Mulai</th>
            <th>Selesai</th>
            {{-- <th>T. Hadir</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($data as $recap)
        <tr>
            <td>{{ $recap->user->nip }}</td>
            <td>{{ $recap->user->nama }}</td>
            <td>{{ $recap->user->pangkat->nama_pangkat }}</td>
            <td>{{ $recap->user->jabatan->nama_jabatan }}</td>
            <td>{{ $recap->tanggal_awal }}</td>
            <td>{{ $recap->tanggal_akhir }}</td>
            {{-- <td>{{ $countTglPresensi - $recap->total_hadir }}</td> --}}
        </tr>
        @endforeach
    </tbody>
</table>
@endsection