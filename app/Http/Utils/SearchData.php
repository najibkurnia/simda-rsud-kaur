<?php

namespace App\Http\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SearchData
{
    public static function find(array $attributes)
    {
        $query = $attributes['model']->where($attributes['field'], 'LIKE', '%' . $attributes['key'] . '%');
        $data = $query;

        return $data;
    }
}
