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
            'start_masuk' => $instance->model->start_masuk,
            'end_masuk' => $instance->model->end_masuk,
            'start_pulang' => $instance->model->start_pulang,
        ];

        return $data[$param];
    }
}
