<?php

namespace Database\Factories;

use App\Models\Permintaan;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class PermintaanFactory extends Factory
{
    protected $model = Permintaan::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'keperluan' => $this->faker->word(),
            'tanggal_awal' => $this->faker->date(),
            'tanggal_akhir' => $this->faker->date(),
            'bukti' => $this->faker->word() . '.jpg',
            'keterangan' => $this->faker->sentence(),
            'status' => 'accepted',
            'tanggal_permintaan' => $this->faker->date(),
            'surat_tugas' => $this->faker->word() . '.pdf',

        ];
    }
}
