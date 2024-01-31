@extends('pdf.index')

@section('render-pdf')
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Pangkat</th>
            <th>Golongan</th>
            <th>Jabatan</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $pg)
        <tr>
            <td>{{ $loop->iteration . '.' }}</td>
            <td>{{ $pg->nip }}</td>
            <td>{{ $pg->nama }}</td>
            <td>{{ $pg->pangkat->nama_pangkat }}</td>
            <td>{{ $pg->golongan->nama_golongan }}</td>
            <td>{{ $pg->jabatan->nama_jabatan }}</td>
            <td>{{ $pg->no_telepon }}</td>
            <td>{{ $pg->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection