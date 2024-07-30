@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="card-title text-white">Data PNS</h5>
            <div class="card-footer">
                <button class="btn btn-info cstm" data-bs-toggle="modal" data-bs-target="#create">Tambah
                    Data</button>
                <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('create-pegawai') }}" class="modal-content">
                                @csrf
                                <div class="modal-body">
                                    <div class="my-2">
                                        <input type="number" min="0" class="form-control" name="nip"
                                            placeholder="NIP" required>
                                    </div>
                                    <div class="my-2">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Pegawai"
                                            required>
                                    </div>
                                    <div class="my-2">
                                        <select name="pangkat_id" required class="form-control">
                                            <option value="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $item)
                                                <option value="{{ $item->pangkat_id }}">{{ $item->nama_pangkat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <select name="golongan_id" required class="form-control">
                                            <option value="">Pilih Golongan</option>
                                            @foreach ($golongan as $item)
                                                <option value="{{ $item->golongan_id }}">
                                                    {{ $item->nama_golongan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <select name="jabatan_id" required class="form-control">
                                            <option value="">Pilih Jabatan</option>
                                            @foreach ($jabatan as $item)
                                                <option value="{{ $item->jabatan_id }}">{{ $item->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-2">
                                        <input type="number" min="0" class="form-control" name="no_telepon"
                                            placeholder="No. Telepon Pegawai" required>
                                    </div>
                                    <div class="my-2">
                                        <textarea name="alamat" id="alamat" placeholder="Alamat Pegawai" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="padding-left:5px">
                    <form action="{{ route('export-pdf-pegawai') }}" method="POST">
                        @csrf
                        <button formtarget="_blank" type="submit" class="btn btn-danger text-light cstm">Cetak PDF</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $pg)
                            <tr>
                                <td>{{ $pg->nip }}</td>
                                <td>{{ $pg->nama }}</td>
                                <td>{{ $pg->pangkat->nama_pangkat }}</td>
                                <td>{{ $pg->golongan->nama_golongan }}</td>
                                <td>{{ $pg->jabatan->nama_jabatan }}</td>
                                <td>{{ $pg->no_telepon }}</td>
                                <td>{{ $pg->alamat }}</td>
                                <td style="white-space: nowrap">
                                    <button class="btn bg-secondary text-light cstm" data-bs-toggle="modal"
                                        data-bs-target="{{ '#update' . $pg->user_id }}">Edit</button>
                                    <button class="btn btn-danger cstm" data-bs-toggle="modal"
                                        data-bs-target="{{ '#delete' . $pg->user_id }}">Hapus</button>
                                </td>
                            </tr>

                            {{-- modal-delete --}}
                            <div class="modal fade" id="{{ 'delete' . $pg->user_id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>
                                                Yakin untuk menghapus akun pegawai
                                                <strong>{{ $pg->nama }}</strong> - ({{ $pg->nip }})
                                            </p>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                            <form method="POST" action="{{ route('delete-pegawai', $pg->user_id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- modal update --}}
                            <div class="modal fade" id="{{ 'update' . $pg->user_id }}" data-backdrop="false" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('update-pegawai', $pg->user_id) }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="my-2">
                                                    <input type="number" min="0" class="form-control"
                                                        name="nip" value="{{ $pg->nip }}" placeholder="NIP"
                                                        required>
                                                </div>
                                                <div class="my-2">
                                                    <input type="text" class="form-control" name="nama"
                                                        value="{{ $pg->nama }}" placeholder="Nama Pegawai" required>
                                                </div>
                                                <div class="my-2">
                                                    <select name="pangkat_id" required class="form-control">
                                                        <option value="{{ $pg->pangkat_id }}">
                                                            {{ $pg->pangkat->nama_pangkat }}</option>
                                                        @foreach ($pangkat as $item)
                                                            <option value="{{ $item->pangkat_id }}">
                                                                {{ $item->nama_pangkat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="my-2">
                                                    <select name="golongan_id" required class="form-control">
                                                        <option value="{{ $pg->golongan_id }}">
                                                            {{ $pg->golongan->nama_golongan }}</option>
                                                        @foreach ($golongan as $item)
                                                            <option value="{{ $item->golongan_id }}">
                                                                {{ $item->nama_golongan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="my-2">
                                                    <select name="jabatan_id" required class="form-control">
                                                        <option value="{{ $pg->jabatan_id }}">
                                                            {{ $pg->jabatan->nama_jabatan }}</option>
                                                        @foreach ($jabatan as $item)
                                                            <option value="{{ $item->jabatan_id }}">
                                                                {{ $item->nama_jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="my-2">
                                                    <input type="number" min="0" value="{{ $pg->no_telepon }}"
                                                        class="form-control" name="no_telepon"
                                                        placeholder="No. Telepon Pegawai" required>
                                                </div>
                                                <div class="my-2">
                                                    <textarea name="alamat" id="alamat" placeholder="Alamat Pegawai" required class="form-control">{{ $pg->alamat }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Keluar</button>
                                                <form method="POST"
                                                    action="{{ route('update-pegawai', $pg->user_id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                                </form>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>


            </div>
        @endsection
