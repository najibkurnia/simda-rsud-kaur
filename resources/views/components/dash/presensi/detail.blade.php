@extends('core.app')

@section('components')
<div class="col-12">
    <a href="{{ route('presensi') }}" class="btn mb-3 bg-back">Kembali</a>
    
    <div class="card bg-card">
        <div class="card-body">
            <div class="row my-3 justify-content-end">
                <form action="{{ route('cari-rekap-riwayat-pegawai', $tanggal_riwayat) }}" class="col-4 d-flex align-items-center" style="gap: 10px">
                    <input type="text" name="query" class="form-control" required placeholder="Cari nama pegawai">
                    @if (request()->routeIs('cari-rekap-riwayat-pegawai'))
                    <a href="{{ route('detail-presensi', $tanggal_riwayat) }}" class="btn border border-secondary rounded-0">Back</a>
                    @endif
                    <button class="btn bg-search">Search</button>
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped" style="white-space: nowrap; border: 1px solid #aaa">
                    <thead class="bg-th">
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Pangkat</th>
                            <th>Jabatan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-td" style="vertical-align: middle">
                        @foreach ($riwayatUser as $riwayat)
                        <tr>
                            <td>{{ $riwayat->user->nip }}</td>
                            <td>{{ $riwayat->user->nama }}</td>
                            <td>{{ $riwayat->user->pangkat->nama_pangkat }}</td>
                            <td>{{ $riwayat->user->jabatan->nama_jabatan }}</td>
                            <td>
                                @if ($riwayat->presensi != null)
                                    @if ($riwayat->presensi->jam_masuk != null)
                                        <span>Masuk - {{ $riwayat->presensi->jam_masuk }}</span>
                                    @else    
                                        <span>Pulang - {{ $riwayat->presensi->jam_pulang }}</span>
                                    @endif
                                @else 
                                    <span>{{ $riwayat->permintaan->keperluan }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ $riwayat->presensi != null ? route('rincian-presensi', [$riwayat->user_id, $riwayat->tanggal_riwayat]) : route('rincian-permintaan', [$riwayat->user_id, $riwayat->tanggal_riwayat]) }}" class="btn bg-primer">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex mb-2 justify-content-between">
                    @if (!$riwayatUser->isEmpty())
                    
                    <p class="border border-dark px-2">Showing {{ $riwayatUser->firstItem() }} to {{ $riwayatUser->lastItem() }} of {{ $riwayatUser->total() }} entries</p>
                    {{ $riwayatUser->links() }}
                    @endif
                    <form action="{{ route('export-pdf-rekap-pegawai', $tanggal_riwayat) }}" method="POST">
                        @csrf
                        <button formtarget="_blank" type="submit" class="btn btn-info text-light">Cetak PDF</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection