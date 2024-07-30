<?php

namespace Database\Seeders;

use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PresensiSeeder extends Seeder
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

        for ($i = 0; $i < 20; $i++) {
            $tanggal_presensi = $faker->dateTimeBetween('-1 month', 'now');
            $jam_masuk = $faker->time($format = 'H:i:s', $max = 'now');
            $jam_pulang = $faker->time($format = 'H:i:s', $max = 'now');
            $status = $faker->randomElement(['Telat', 'Tepat Waktu']);

            Presensi::create([
                'user_id' => $faker->randomElement($userIds), // Ambil user_id yang valid
                'tanggal_presensi' => $tanggal_presensi->format('d-m-Y'),
                'jam_masuk' => $jam_masuk,
                'jam_pulang' => $jam_pulang,
                'status' => $status,
                'bukti_masuk' => $faker->word . '.jpg',
                'bukti_pulang' => $faker->word . '.jpg',
                'total_waktu' => gmdate('H:i:s', strtotime($jam_pulang) - strtotime($jam_masuk)),
            ]);
        }
    }
}
