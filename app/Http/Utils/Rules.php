<?php

namespace App\Http\Utils;

use App\Models\Rule;

class Rules
{
    protected $model;
    public function __construct()
    {
        $this->model = Rule::where('status', 'used')->first();
    }

    public  static function use($param)
    {
        $instance = new self();
        $data = [
            'start_masuk' => "12:00:00",
            'end_masuk' => "14:00:00",
            'start_pulang' => "15:10:00",
            'longitude' => $instance->model->longitude,
            'latitude' => $instance->model->latitude,
        ];

        return $data[$param];
    }
}
