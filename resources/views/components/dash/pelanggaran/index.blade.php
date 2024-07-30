@extends('core.app')

@section('components')
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="card-title text-white">Data Pelanggaran</h5>
            @if (!$recapPelanggaran->isEmpty())
                <form action="{{ route('export-pdf-pelanggaran') }}" method="POST">
                    @csrf
                    <button formtarget="_blank" type="submit" class="btn btn-danger text-light cstm">Cetak PDF</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('data-pelanggaran') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <label for="year">Filter Tahun</label> --}}
                            <select id="year" name="year" class="form-control">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="data1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>T.Hadir</th>
                            <th>Telat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recapPelanggaran as $recap)
                            <tr>
                                <td>{{ $recap->nip }}</td>
                                <td>{{ $recap->nama }}</td>
                                <td>{{ $recap->pangkat->nama_pangkat }}</td>
                                <td style="text-align: center">{{ $recap->golongan->nama_golongan }}</td>
                                <td>{{ $recap->jabatan->nama_jabatan }}</td>
                                <td style="text-align: center">{{ $countTglPresensi - $recap->total_hadir }}</td>
                                <td style="text-align: center">{{ $recap->total_telat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">

            </div>
        </div>
    </div>

    {{-- <style>
        .card-header {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
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
    </style> --}}
@endsection
