@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="card-title text-white">Data Permintaan</h5>
            <div class="card-footer">
                <div>
                    @if (!$recapPermintaan->isEmpty())
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('export-pdf-permintaan') }}" method="POST">
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
                <table id="data2" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Permintaan</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sortedRecapPermintaan = $recapPermintaan->sortBy(function ($recap) {
                                switch ($recap->permintaan->status) {
                                    case 'pending':
                                        return 0;
                                    case 'accepted':
                                        return 1;
                                    case 'rejected':
                                        return 2;
                                    default:
                                        return 3; // for any other status (if any)
                                }
                            });
                        @endphp
                        @foreach ($sortedRecapPermintaan as $recap)
                            <tr>
                                <td>{{ $recap->user->nip }}</td>
                                <td>{{ $recap->user->nama }}</td>
                                <td>{{ $recap->user->jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($recap->permintaan->status == 'rejected')
                                        <span
                                            class="bg-danger rounded text-light px-2">{{ ucfirst($recap->permintaan->status) }}</span>
                                    @elseif($recap->permintaan->status == 'accepted')
                                        <span
                                            class="bg-success rounded text-light px-2">{{ ucfirst($recap->permintaan->status) }}</span>
                                    @elseif($recap->permintaan->status == 'pending')
                                        <span
                                            class="bg-warning rounded text-light px-2">{{ ucfirst($recap->permintaan->status) }}</span>
                                    @else
                                        <span class="bg-primer rounded text-light px-2">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $recap->permintaan->keperluan }}</td>
                                <td>{{ $recap->permintaan->tanggal_permintaan }}</td>
                                <td><a href="{{ route('rincian-permintaan', [$recap->user->user_id, $recap->riwayat_id]) }}"
                                        class="btn btn-primary cstm">Detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
