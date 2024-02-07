@extends('pdf.index')

@section('render-pdf')
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Pangkat</th>
            <th>Golongan</th>
            <th>Jabatan</th>
            <th>T. Hadir</th>
            <th>Telat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $recap)
        <tr>
            <td>{{ $recap->nip }}</td>
            <td>{{ $recap->nama }}</td>
            <td>{{ $recap->pangkat->nama_pangkat }}</td>
            <td>{{ $recap->golongan->nama_golongan }}</td>
            <td>{{ $recap->jabatan->nama_jabatan }}</td>
            <td>{{ $countTglPresensi - $recap->total_hadir }}</td>
            <td>{{ $recap->total_telat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection