<?php

// database/factories/JabatanFactory.php

namespace Database\Factories;

use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JabatanFactory extends Factory
{
    protected $model = Jabatan::class;

    public function definition()
    {
        return [
            'nama_jabatan' => $this->faker->word(),
        ];
    }
}
