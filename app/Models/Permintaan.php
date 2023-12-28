<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaan';
    protected $primaryKey = 'permintaan_id';
    protected $fillable = [
        'user_id',
        'jenis_permintaan',
        'keperluan',
        'tanggal_awal',
        'tanggal_akhir',
        'keterangan',
        'surat_dinas',
        'bukti_izin',
        'status'
    ];
}
