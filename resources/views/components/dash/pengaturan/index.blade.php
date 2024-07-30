@extends('core.app')

@section('components')
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Ketentuan umum
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <form action="{{ route('create-rule') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-3">
                                <label for="">Jam Awal Masuk</label>
                                <input type="time" class="form-control" required name="start_masuk"
                                    placeholder="Jam Mulai Masuk">
                            </div>
                            <div class="col-3">
                                <label for="">Jam Akhir Masuk</label>
                                <input type="time" class="form-control" required name="end_masuk"
                                    placeholder="Jam Mulai Masuk">
                            </div>
                            <div class="col-3">
                                <label for="">Jam Pulang</label>
                                <input type="time" class="form-control" required name="start_pulang"
                                    placeholder="Jam Mulai Masuk">
                            </div>
                        </div>

                        <input type="checkbox" @if ($umum->isEmpty()) required @endif value="used"
                            name="status" id="status">
                        <label for="status">Gunakan ini untuk ketentuan umum</label>

                        <div class="mt-3">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="data" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jam Mulai Masuk</th>
                                    <th>Jam Akhir Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($umum as $ketu)
                                    <tr style="vertical-align: middle;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ketu->start_masuk }}</td>
                                        <td>{{ $ketu->end_masuk }}</td>
                                        <td>{{ $ketu->start_pulang }}</td>
                                        <td style="white-space: nowrap">
                                            @if ($ketu->status == 'unused')
                                                <form action="{{ route('use-rule', $ketu->rule_id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary cstm">
                                                        Gunakan
                                                    </button>
                                                </form>

                                                <form action="{{ route('delete-rule', $ketu->rule_id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger cstm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <i>Digunakan</i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Ketentuan Jaringan
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <form action="{{ route('create-jaringan') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-betwen mb-3" style="gap: 15px;">
                            <input type="text" required class="form-control" name="nama_jaringan"
                                placeholder="Nama Perangkat Jaringan">
                            <input type="text" required class="form-control" name="ip_address" placeholder="IP Address">

                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                    </form>
                    <div class="table-responsive">
                        <table id="data" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Perangkat Jaringan</th>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jaringan as $jar)
                                    <tr style="vertical-align: middle;">
                                        <td>{{ $jar->nama_jaringan }}</td>
                                        <td>{{ $jar->ip_address }}</td>
                                        <td style="white-space: nowrap">
                                            <form action="{{ route('delete-jaringan', $jar->jaringan_id) }}" method="POST"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger cstm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
