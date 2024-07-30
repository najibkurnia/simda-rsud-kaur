@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Datail {{ ucwords($riwayat->permintaan->keperluan) }} {{ $user->nama }}</h5>
            <div class="">
                <a href="{{ route('data-permintaan') }}" class="btn btn-success cstm">Kembali</a>
            </div>
        </div>
        <div class="card-body rc-permintaan" style="gap: 20px">
            <div style="height:300px; width: 400px">
                <img src="{{ asset('storage/permintaan/' . $riwayat->permintaan->bukti) }}" class="img-thumbnail"
                    style="width: 100%; height: 100%; object-fit: cover;" alt="">
            </div>
            <div class="table-responsive col-7">
                <div class="d-flex justify-content-between flex-row">
                    <div class="col">
                        <p>Tanggal Awal:</p>
                    </div>
                    <div class="col">
                        <p>{{ $riwayat->permintaan->tanggal_awal ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-row">
                    <div class="col">
                        <p>Tanggal Akhir:</p>
                    </div>
                    <div class="col">
                        <p>{{ $riwayat->permintaan->tanggal_akhir ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-row">
                    <div class="col">
                        <p>Keterangan:</p>
                    </div>
                    <div class="col">
                        <p style="text-align: justify">{{ $riwayat->permintaan->keterangan ?? 'N/A' }}</p>
                    </div>
                </div>

                @if ($riwayat->permintaan->status == 'pending')
                    <div class="d-flex justify-content-between flex-row">
                        <div class="col">
                            <p>Status:</p>
                        </div>
                        <div class="col">
                            <p class="bg-warning rounded text-light px-2" style="display: inline-block">
                                {{ ucfirst($riwayat->permintaan->status) ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="col">

                        </div>
                        <div class="col d-flex justify-content-between" style="gap: 10px;">
                            <form action="{{ route('accepted', $riwayat->permintaan->permintaan_id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary cstm-izin">Izinkan</button>
                            </form>

                            <form action="{{ route('rejected', $riwayat->permintaan->permintaan_id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-danger cstm-tolak">Tolak</button>
                            </form>
                        </div>

                    </div>
                @endif

                @if ($riwayat->permintaan->status != 'pending')
                    <div class="d-flex justify-content-between flex-row">
                        <div class="col">
                            <p>Status:</p>
                        </div>
                        <div class="col">
                            <p>
                                @if ($riwayat->permintaan->status == 'rejected')
                                    <span
                                        class="bg-danger rounded text-light px-2">{{ ucfirst($riwayat->permintaan->status) ?? 'N/A' }}
                                    </span>
                                @elseif($riwayat->permintaan->status == 'accepted')
                                    <span
                                        class="bg-success rounded text-light px-2">{{ ucfirst($riwayat->permintaan->status) ?? 'N/A' }}
                                    </span>
                                @endif
                            </p>
                        </div>

                    </div>
                @endif


                @if ($riwayat->permintaan->status == 'accepted')
                    @if (in_array($riwayat->permintaan->keperluan, ['Dinas', 'Cuti Tahunan', 'Cuti Hamil']))
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <p>Lampiran:</p>
                            </div>
                            <div class="col">
                                @if ($riwayat->permintaan->surat_tugas == null)
                                    <button class="btn btn-info text-light cstm" data-bs-toggle="modal"
                                        data-bs-target="#upload"><strong>Upload</strong></button>
                                    <div class="modal fade" id="upload" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST"
                                                    action="{{ route('upload-attachment', $riwayat->permintaan->permintaan_id) }}"
                                                    class="modal-content" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <p class="mb-1">Lampirkan File</p>
                                                        <input accept=".pdf, .png, .jpeg, .jpg" type="file"
                                                            name="surat_tugas" class="form-control">
                                                    </div>
                                                    <div class="modal-footer border-0 justify-content-start">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn bg-primer">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ asset('storage/lampiran/' . $riwayat->permintaan->surat_tugas) }}"
                                        target="_blank">Lihat File</a>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
