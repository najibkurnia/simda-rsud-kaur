@extends('pdf.index')

@section('render-pdf')
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Pangkat</th>
            <th>Jabatan</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $riwayat)
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
        </tr>
        @endforeach
    </tbody>
</table>
@endsection