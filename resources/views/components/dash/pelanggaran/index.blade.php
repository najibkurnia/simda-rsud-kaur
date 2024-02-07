@extends('core.app')

@section('components')
    <div class="col-12">
        <div class="card bg-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>
                    <form action="{{ route('cari-pelanggaran') }}" class="d-flex col-4">
                        <input type="text" name="query" required class="form-control me-0 me-lg-2" placeholder="Cari nama pegawai" id="">
                        @if (request()->routeIs('cari-pelanggaran'))
                        <a href="{{ route('data-pelanggaran') }}" class="btn border me-0 me-lg-2 border-secondary rounded-0">Back</a>
                        @endif
                        <button class="btn bg-search">Search</button>
                    </form>
                </div>

                <div class="table-responsive my-4 col-12">
                    <table class="table table-striped">
                        <thead class="bg-th">
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
                        <tbody class="bg-td">
                            @foreach($recapPelanggaran as $recap)
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

                    <div class="d-flex mb-2 justify-content-between">
                        @if (!$recapPelanggaran->isEmpty())
                        
                        <p class="border border-dark px-2">Showing {{ $recapPelanggaran->firstItem() }} to {{ $recapPelanggaran->lastItem() }} of {{ $recapPelanggaran->total() }} entries</p>
                        {{ $recapPelanggaran->links() }}
                        @endif
    
                    </div>

                    @if (!$recapPelanggaran->isEmpty())
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('export-pdf-pelanggaran') }}" method="POST">
                            @csrf
                            <button formtarget="_blank" type="submit" class="btn btn-info text-light">Cetak PDF</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection