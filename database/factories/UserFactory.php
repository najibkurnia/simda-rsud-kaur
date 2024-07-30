<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Golongan;
use App\Models\Jabatan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => static::$password ??= Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ];
        return [
            'nip' => $this->faker->numerify('##########'),
            'nama' => $this->faker->name(),
            'pangkat_id' => Pangkat::factory(),
            'golongan_id' => Golongan::factory(),
            'jabatan_id' => Jabatan::factory(),
            'no_telepon' => $this->faker->phoneNumber(),
            'role' => 'pegawai',
            'alamat' => $this->faker->address(),
            'password' => Hash::make('password'),
            'total_hadir' => 0,
            'total_dinas' => 0,
            'total_cuti' => 0,
            'total_izin' => 0,
            'total_sakit' => 0,
            'total_telat' => 0,
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
