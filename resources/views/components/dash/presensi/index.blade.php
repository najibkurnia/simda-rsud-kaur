@extends('core.app')

@section('components')
<div class="col-12 mb-5">
    <div class="card bg-card">
        <div class="card-body">
            <strong>
                <span>PRESENSI HARI INI</span>
            </strong>
            <div class="my-3">
                <div class="p-2 bg-primer rounded d-inline">Presensi</div>
            </div>
            
            <div class="table-responsive my-3">
                <table class="table" style="white-space: nowrap; border: 1px solid #aaa">
                    <thead class="bg-th">
                        <tr>
                            <th>Pegawai</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Dinas</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Cuti</th>
                            <th>Total</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-td" style="vertical-align: middle">
                        @foreach ($riwayatNow as $rn)
                        <tr>
                            <td>{{ $ttl_pegawai }}</td>
                            <td>{{ $rn->jumlah_jam_masuk}}</td>
                            <td>{{ $rn->jumlah_jam_pulang}}</td>
                            <td>{{ $rn->jumlah_dinas }}</td>
                            <td>{{ $rn->jumlah_izin }}</td>
                            <td>{{ $rn->jumlah_sakit }}</td>
                            <td>{{ $rn->jumlah_cuti }}</td>
                            <td>{{ $rn->jumlah_riwayat }}</td>
                            <td>
                                <a href="{{ route('detail-presensi', $rn->tanggal_riwayat) }}" class="btn bg-primer">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                
                
                @if ($riwayatNow->isEmpty())
                <p class="text-secondary">Data presensi dan permintaan belum ada hari ini!</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card bg-card">
        <div class="card-body">
            <strong>
                <span>RIWAYAT PRESENSI</span>
            </strong>
            
            <div class="row my-3 justify-content-end">
                <form action="{{ route('cari-rekap-riwayat') }}" class="col-4 d-flex align-items-center" style="gap: 10px">
                    <input type="date" name="query" required class="form-control">
                    @if (request()->routeIs('cari-rekap-riwayat'))
                    <a href="{{ route('presensi') }}" class="btn border border-secondary rounded-0">Back</a>
                    @endif
                    <button class="btn bg-search">Search</button>
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped" style="white-space: nowrap; border: 1px solid #aaa">
                    <thead class="bg-th">
                        <tr>
                            <th>Tanggal</th>
                            <th>Pegawai</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Dinas</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Cuti</th>
                            <th>Total</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-td" style="vertical-align: middle">
                        @foreach($riwayatPrev as $rp) 
                        <tr>
                            <td>{{ $rp->tanggal_riwayat }}</td>
                            <td>{{ $ttl_pegawai }}</td>
                            <td>{{ $rp->jumlah_jam_masuk }}</td>
                            <td>{{ $rp->jumlah_jam_pulang }}</td>
                            <td>{{ $rp->jumlah_dinas }}</td>
                            <td>{{ $rp->jumlah_izin }}</td>
                            <td>{{ $rp->jumlah_sakit }}</td>
                            <td>{{ $rp->jumlah_cuti }}</td>
                            <td>{{ $rp->jumlah_riwayat }}</td>
                            <td>
                                <a href="{{ route('detail-presensi', $rp->riwayat_id) }}" class="btn bg-primer">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex mb-2 justify-content-between">
                    @if (!$riwayatPrev->isEmpty())
                    
                    <p class="border border-dark px-2">Showing {{ $riwayatPrev->firstItem() }} to {{ $riwayatPrev->lastItem() }} of {{ $riwayatPrev->total() }} entries</p>
                    {{ $riwayatPrev->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection