<?php

namespace Database\Factories;

use App\Models\Pangkat;
use Illuminate\Database\Eloquent\Factories\Factory;

class PangkatFactory extends Factory
{
    protected $model = Pangkat::class;

    public function definition()
    {
        return [
            'nama_pangkat' => $this->faker->word(),
        ];
    }
}
