<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $primaryKey = 'rule_id';
    protected $fillable = [
        'start_masuk',
        'end_masuk',
        'start_pulang',
        'status'
    ];
}
