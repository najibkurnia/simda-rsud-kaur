<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $primaryKey = 'presensi_id';
    protected $fillable = [
        'user_id',
        'jenis_absen',
        'tanggal_presensi',
        'jam_masuk',
        'jam_pulang',
    ];
}
