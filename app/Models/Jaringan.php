<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jaringan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'jaringan';
    protected $primaryKey = 'jaringan_id';
    protected $fillable = [
        'nama_jaringan',
        'ip_address'
    ];
}
