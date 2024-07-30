<?php

// database/factories/GolonganFactory.php

namespace Database\Factories;

use App\Models\Golongan;
use Illuminate\Database\Eloquent\Factories\Factory;

class GolonganFactory extends Factory
{
    protected $model = Golongan::class;

    public function definition()
    {
        return [
            'nama_golongan' => $this->faker->word(),
        ];
    }
}
