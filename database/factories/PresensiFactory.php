<?php

namespace Database\Factories;

use App\Models\Presensi;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class PresensiFactory extends Factory
{
    protected $model = Presensi::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'tanggal_presensi' => $this->faker->date(),
            'jam_masuk' => $this->faker->time(),
            'jam_pulang' => $this->faker->time(),
            'status' => 'Tepat Waktu',
            'bukti_masuk' => $this->faker->word() . '.jpg',
            'bukti_pulang' => $this->faker->word() . '.jpg',
            'total_waktu' => $this->faker->time('H:i:s')
        ];
    }
}
