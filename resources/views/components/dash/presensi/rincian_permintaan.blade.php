@extends('core.app')

@section('components')
<div class="col-12">
    <button onclick="history.back()" class="btn mb-3 bg-back">Kembali</button>
    
    <div class="card bg-card">
        <div class="card-body m-2">
            
            <h5 class="mb-4">DETAIL {{ strtoupper($permintaan->keperluan) }} {{ $user->nama }}</h5>
            
            <div class="row justify-content-around">
                <div class="col-4 p-0 border border-dark" style="height:50vh; width: 25vw">
                    <img src="{{ asset('storage/permintaan/'.$permintaan->bukti) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="">
                </div>
                <div class="table-responsive col-7">
                    <div class="bg-td border border-dark" style="padding: 10px;">
                        <div class="d-flex justify-content-between flex-row">
                            <p>Tanggal Awal:</p>
                            <p>{{ $permintaan->tanggal_awal ?? 'N/A' }}</p>
                        </div>
                        <div class="d-flex justify-content-between flex-row">
                            <p>Tanggal Akhir:</p>
                            <p>{{ $permintaan->tanggal_akhir ?? 'N/A' }}</p>
                        </div>
                        <div class="d-flex justify-content-between flex-row">
                            <p>Keterangan:</p>
                            <p>{{ $permintaan->keterangan ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection