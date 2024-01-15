@extends('core.app')

@section('components')
    <div class="col-12">
        <div class="card border-primer">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>{{ $title }}</h4>          
                    
                    <form method="GET" action="{{ route('cari-pegawai') }}" class="d-flex col-4">
                        <input type="text" name="key" class="form-control me-0 me-lg-2" placeholder="Cari NIP" id="key">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </form>
                </div>


                <form method="POST" action="{{ route('create-pegawai') }}" class="d-flex col-4">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Create</button>
                </form>

                <div class="table-responsive my-4 col-12">
                    <table class="table table-striped">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>Golongan</th>
                                <th>Jabatan</th>
                                <th>No. Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: middle">
                            @foreach ($pegawai as $item)
                            <tr>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->pangkat->nama_pangkat }}</td>
                                <td>{{ $item->golongan->nama_golongan }}</td>
                                <td>{{ $item->jabatan->nama_jabatan }}</td>
                                <td>{{ $item->no_telepon }}</td>
                                <td>
                                    <button class="btn btn-secondary">Edit</button>
                                    <button class="btn btn-secondary">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection