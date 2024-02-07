@extends('pdf.index')

@section('render-pdf')
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Pangkat</th>
            <th>Jabatan</th>
            <th>Hadir</th>
            <th>Dinas</th>
            <th>Cuti</th>
            <th>Izin</th>
            <th>Sakit</th>
            <th>T. Hadir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $recap)
        <tr>
            <td>{{ $recap->nip }}</td>
            <td>{{ $recap->nama }}</td>
            <td>{{ $recap->pangkat->nama_pangkat }}</td>
            <td>{{ $recap->jabatan->nama_jabatan }}</td>
            <td>{{ $recap->total_hadir }}</td>
            <td>{{ $recap->total_dinas }}</td>
            <td>{{ $recap->total_cuti }}</td>
            <td>{{ $recap->total_izin }}</td>
            <td>{{ $recap->total_sakit }}</td>
            <td>{{ $countTglPresensi - $recap->total_hadir }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection