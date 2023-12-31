<?php

namespace App\Http\Utils;

class ApiCollection
{
    static function apiUrl()
    {
        return env('APP_API_URL');
    }

    public static function endpoint()
    {
        $data = [
            'getPegawai'    => self::apiUrl() . '/pegawai'
        ];

        return $data;
    }
}
