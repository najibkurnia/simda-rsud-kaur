@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title text-white">Rekap Absensi Bulanan</h5>
            <form action="{{ route('export-pdf-rekap-bulanan') }}" method="POST">
                @csrf
                <button formtarget="_blank" type="submit" class="btn btn-danger text-light cstm">Cetak PDF</button>
            </form>
        </div>
        <div class="card-body">
            <form action="{{ route('rekap-presensi') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="month">Bulan</label>
                            <select id="month" name="month" class="form-control">
                                <option value="" disabled selected>Pilih Bulan</option>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select id="year" name="year" class="form-control">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @foreach (range(date('Y'), date('Y') - 10) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Filter</button>
            </form>

            <div class="table-responsive mt-4">
                <table id="data1" class="table table-striped" style="width:100%">
                    <thead class="thead-dark">
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
                            <th>T.Hadir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recaps as $recap)
                            <tr>
                                <td style="text-align: left">{{ $recap->nip }}</td>
                                <td>{{ $recap->nama }}</td>
                                <td>{{ $recap->pangkat->nama_pangkat }}</td>
                                <td>{{ $recap->jabatan->nama_jabatan }}</td>
                                <td style="text-align: center">{{ $recap->total_hadir }}</td>
                                <td style="text-align: center">{{ $recap->total_dinas }}</td>
                                <td style="text-align: center">{{ $recap->total_cuti }}</td>
                                <td style="text-align: center">{{ $recap->total_izin }}</td>
                                <td style="text-align: center">{{ $recap->total_sakit }}</td>
                                <td style="text-align: center">{{ $countTglPresensi - $recap->total_hadir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">

        </div>
    </div>

    {{-- <style>
        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0.25rem;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .btn-block {
            width: 100%;
        }

        .thead-dark th {
            background-color: #343a40;
            color: white;
        }
    </style> --}}
@endsection
