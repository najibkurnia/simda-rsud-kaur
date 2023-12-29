@extends('core.app')

@section('components')
    <div class="col-12 mb-5">
       <div class="card border-primer">
        <div class="card-body">
            <strong>
                <span>PRESENSI HARI INI</span>
            </strong>
            <div class="my-3">
                <button class="btn btn-secondary">Presensi</button>
            </div>

            <div class="table-responsive my-3">
                <table class="table" style="white-space: nowrap; border: 1px solid #aaa">
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th>Pegawai</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Dinas</th>
                            <th>Izin</th>
                            <th>Cuti</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody style="vertical-align: middle">
                        <tr>
                            <td>144</td>
                            <td>100</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>100</td>
                            <td>
                                <button class="btn btn-secondary">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       </div>
    </div>

    <div class="col-12">
        <div class="card border-primer">
         <div class="card-body">
             <strong>
                <span>RIWAYAT PRESENSI</span>
             </strong>

             <div class="row my-3 justify-content-end">
                <div class="col-4 d-flex align-items-center" style="gap: 10px">
                    <select name="" class="form-control" required id="">
                        <option value="">Pilih Tanggal</option>
                        <option value="">lainnya</option>
                    </select>
                    <button class="btn btn-secondary">Search</button>
                </div>
             </div>

             <div class="table-responsive">
                 <table class="table table-striped" style="white-space: nowrap; border: 1px solid #aaa">
                     <thead class="bg-secondary text-light">
                         <tr>
                             <th>Tanggal</th>
                             <th>Pegawai</th>
                             <th>Masuk</th>
                             <th>Pulang</th>
                             <th>Dinas</th>
                             <th>Izin</th>
                             <th>Cuti</th>
                             <th>Total</th>
                             <th>Detail</th>
                         </tr>
                     </thead>
 
                     <tbody style="vertical-align: middle">
                        @for($i=1; $i <= 5; $i++) 
                        <tr>
                            <td>18-Feb-2023</td>
                            <td>144</td>
                            <td>100</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>100</td>
                            <td>
                                <button class="btn btn-secondary">Detail</button>
                            </td>
                        </tr>
                        @endfor
                     </tbody>
                 </table>
             </div>
         </div>
        </div>
     </div>
@endsection