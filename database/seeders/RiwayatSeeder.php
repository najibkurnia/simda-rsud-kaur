<?php

namespace Database\Seeders;

use App\Models\Riwayat;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Permintaan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RiwayatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua user_id yang ada di tabel users
        $userIds = User::pluck('user_id')->toArray();
        // Ambil semua presensi_id yang ada di tabel presensi
        $presensiIds = Presensi::pluck('presensi_id')->toArray();
        // Ambil semua permintaan_id yang ada di tabel permintaan
        $permintaanIds = Permintaan::pluck('permintaan_id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Riwayat::create([
                'tanggal_riwayat' => $faker->dateTimeBetween('-1 month', 'now')->format('d-m-Y'),
                'user_id' => $faker->randomElement($userIds), // Ambil user_id yang valid
                'detail_presensi' => $faker->randomElement(['Masuk', 'Pulang']),
                'presensi_id' => $faker->randomElement($presensiIds), // Ambil presensi_id yang valid atau null
                'permintaan_id' => $faker->randomElement($permintaanIds), // Ambil permintaan_id yang valid atau null
                'created_time_at' => $faker->time($format = 'H:i:s', $max = 'now'),
            ]);
        }
    }
}
