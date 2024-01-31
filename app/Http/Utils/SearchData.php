<?php

namespace App\Http\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SearchData
{
    public static function find(array $attr)
    {
        $query = $attr['model']->where($attr['field'], 'LIKE', '%' . $attr['key'] . '%');
        $data = $query;

        return $data;
    }
}
