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
                        
                        @if ($permintaan->status == 'pending')  
                        <div class="mt-5 d-flex" style="gap: 10px;">
                            <form action="{{ route('accepted', $permintaan->permintaan_id) }}" method="POST">
                                @method('PUT')
                                @csrf    
                                <button class="btn bg-primer px-5"><strong>Izinkan</strong></button>
                            </form>
                            
                            <form action="{{ route('rejected', $permintaan->permintaan_id) }}" method="POST">
                                @method('PUT')
                                @csrf    
                                <button class="btn btn-danger px-5"><strong>Tolak</strong></button>
                            </form>
                        </div>   
                        
                        @endif
                        
                        @if ($permintaan->status != 'pending')
                        <div class="d-flex justify-content-between flex-row">
                            <p>Status:</p>
                            <p class="{{ $permintaan->status == 'rejected' ? 'bg-danger' : 'bg-primer' }} rounded text-light px-2">{{ ucfirst($permintaan->status) ?? 'N/A' }}</p>
                        </div>
                        @endif

                        
                        @if ($permintaan->status == 'accepted')
                        @if (in_array($permintaan->keperluan, ['Dinas', 'Cuti Tahunan', 'Cuti Hamil']))
                        <div class="d-flex justify-content-between">
                            <p>Lampiran:</p>
                            @if ($permintaan->surat_tugas == null)
                            <button class="btn btn-info px-5 text-light" data-bs-toggle="modal" data-bs-target="#upload"><strong>Upload</strong></button>
                            <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('upload-attachment', $permintaan->permintaan_id) }}" class="modal-content" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <p class="mb-1">Lampirkan File</p>
                                                <input accept=".pdf, .png, .jpeg, .jpg" type="file" name="surat_tugas" class="form-control">
                                            </div>
                                            <div class="modal-footer border-0 justify-content-start">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn bg-primer">Simpan</button>
                                            </div>
                                        </form> 
                                    </div>
                                </div>
                            </div>

                            @else
                            <a href="{{ asset('storage/lampiran/'.$permintaan->surat_tugas) }}" target="_blank">Lihat File</a>
                            @endif
                        </div>
                        @endif
                        @endif
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</div>
@endsection