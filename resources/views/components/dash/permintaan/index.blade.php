@extends('core.app')

@section('components')
    <div class="col-12">
        <div class="card bg-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>
                    <form action="{{ route('cari-permintaan') }}" class="d-flex col-4">
                        <input type="text" name="query" required class="form-control me-0 me-lg-2" placeholder="Cari nama pegawai" id="">
                        @if (request()->routeIs('cari-permintaan'))
                        <a href="{{ route('data-permintaan') }}" class="btn border me-0 me-lg-2 border-secondary rounded-0">Back</a>
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
                                <th>Jabatan</th>
                                <th>Permintaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-td">
                            @foreach($recapPermintaan as $recap)
                            <tr>
                                <td>{{ $recap->user->nip }}</td>
                                <td>{{ $recap->user->nama }}</td>
                                <td>{{ $recap->user->jabatan->nama_jabatan }}</td>
                                <td>{{ $recap->keperluan }}</td>
                                <td><a href="#" class="btn bg-primer">Detail</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex mb-2 justify-content-between">
                        @if (!$recapPermintaan->isEmpty())
                        
                        <p class="border border-dark px-2">Showing {{ $recapPermintaan->firstItem() }} to {{ $recapPermintaan->lastItem() }} of {{ $recapPermintaan->total() }} entries</p>
                        {{ $recapPermintaan->links() }}
                        @endif
    
                    </div>

                    @if (!$recapPermintaan->isEmpty())
                    <p class="d-flex justify-content-end">
                        <form action="{{ route('export-pdf-permintaan') }}" method="POST">
                            @csrf
                            <button formtarget="_blank" type="submit" class="btn btn-info text-light">Cetak PDF</button>
                        </form>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection