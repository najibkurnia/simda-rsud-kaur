<?php

namespace App\Http\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SearchData
{
    public static function find($table, $searchKey, $field)
    {
        $query = $table->where($field, 'LIKE', "%" . $searchKey . "%");
        $data = $query->get();

        return $data;
    }
}
