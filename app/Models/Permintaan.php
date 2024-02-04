<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permintaan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'permintaan';
    protected $primaryKey = 'permintaan_id';
    protected $fillable = [
        'user_id',
        'keperluan',
        'tanggal_awal',
        'tanggal_akhir',
        'bukti',
        'keterangan',
        'status',
        'tanggal_permintaan',
        'surat_tugas',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
