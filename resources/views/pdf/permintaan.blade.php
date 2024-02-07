@extends('pdf.index')

@section('render-pdf')
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Permintaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $recap)
        <tr>
            <td>{{ $recap->user->nip }}</td>
            <td>{{ $recap->user->nama }}</td>
            <td>{{ $recap->user->jabatan->nama_jabatan }}</td>
            <td>{{ $recap->permintaan->keperluan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection