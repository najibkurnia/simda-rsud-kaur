@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Detail Presensi {{ $user->nama }}</h5>
            <button onclick="history.back()" class="btn btn-success cstm">Kembali</button>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col" style="height: 250px">
                    <img src="{{ asset('storage/presensi/' . $riwayat->presensi->bukti_masuk) }}" class="img-thumbnail"
                        style="width: 100%; height: 100%; object-fit: cover;" alt="">
                </div>
                <div class="table-responsive col-7">
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Presensi Masuk</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 300px">
                                    <p style="margin: 0">Jadwal Masuk</p>
                                </td>
                                <td>
                                    <p style="margin: 0">{{ $jadwal_masuk ?? 'N/A' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin: 0">Presensi Masuk</p>
                                </td>
                                <td>
                                    <p style="margin: 0">{{ $riwayat->presensi->jam_masuk ?? 'N/A' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin: 0">Status Presensi</p>
                                </td>
                                <td>
                                    <p style="margin: 0">{{ $riwayat->presensi->status }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col" style="height: 250px">
                    @if ($riwayat->presensi->bukti_pulang != null)
                        <div class="col" style="height:250px;">
                            <img src="{{ asset('storage/presensi/' . $riwayat->presensi->bukti_pulang) }}"
                                class="img-thumbnail" style="width: 100%; height: 100%; object-fit: cover;" alt="">
                        </div>
                    @else
                        <div class="col" style="height:250px;">
                            <img src="{{ asset('img/blank-profile.jpg') }}" class="img-thumbnail"
                                style="width: 100%; height: 100%; object-fit: cover;" alt="">
                        </div>
                    @endif
                </div>
                <div class="table-responsive col-7">
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Presensi Pulang</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td style="width: 300px">
                                    <p style="margin: 0;">Jadwal Pulang</p>
                                </td>
                                <td>
                                    <p style="margin: 0">{{ $jadwal_pulang ?? 'N/A' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin: 0">Presensi Pulang</p>
                                </td>
                                <td>
                                    <p style="margin: 0">{{ $riwayat->presensi->jam_pulang ?? '-' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin: 0">Total Waktu</p>
                                </td>
                                <td>
                                    <p style="margin: 0">{{ $riwayat->presensi->total_waktu ?? '-' }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
