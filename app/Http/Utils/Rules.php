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
            'start_masuk' => "00:00:00",
            'end_masuk' => "02:30:00",
            'start_pulang' => "04:00:00",
            'longitude' => $instance->model->longitude,
            'latitude' => $instance->model->latitude,
        ];

        return $data[$param];
    }
}
