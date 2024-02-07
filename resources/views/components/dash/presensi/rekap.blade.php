@extends('core.app')

@section('components')
<div class="col-12">
    <div class="card bg-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>{{ $title }}</h4>          
                {{-- <div class="d-flex col-4">
                    <select name="date" class="form-control me-lg-2" id="">
                        <option value="">Pilih Bulan</option>
                    </select>
                    <button class="btn bg-search">Tampilkan</button>
                </div> --}}
                <form action="{{ route('cari-rekap-bulanan-pegawai') }}" class="d-flex col-4">
                    <input type="text" name="query" class="form-control me-0 me-lg-2" placeholder="Cari NIP atau nama pegawai">
                    @if (request()->routeIs('cari-rekap-bulanan-pegawai'))
                    <a href="{{ route('rekap-presensi') }}" class="btn border border-secondary rounded-0 me-0 me-lg-2">Back</a>
                    @endif
                    <button type="submit" class="btn bg-search">Search</button>
                </form>
            </div>
            
            <div class="table-responsive my-4 col-12">
                <table class="table table-striped">
                    <thead class="bg-th">
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
                    <tbody class="bg-td">
                        @foreach($recaps as $recap)
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

                <div class="d-flex mb-2 justify-content-between">
                    @if (!$recaps->isEmpty())
                    
                    <p class="border border-dark px-2">Showing {{ $recaps->firstItem() }} to {{ $recaps->lastItem() }} of {{ $recaps->total() }} entries</p>
                    {{ $recaps->links() }}
                    @endif

                    <form action="{{ route('export-pdf-rekap-bulanan') }}" method="POST">
                        @csrf
                        <button formtarget="_blank" type="submit" class="btn btn-info text-light">Cetak PDF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection