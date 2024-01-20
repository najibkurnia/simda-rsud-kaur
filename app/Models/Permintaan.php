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
        'keperluan',
        'tanggal_awal',
        'tanggal_akhir',
        'bukti',
        'keterangan',
        'status'
    ];
}
