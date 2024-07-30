<?php

namespace Database\Seeders;

use App\Models\Permintaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PermintaanSeeder extends Seeder
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
            $tanggal_awal = $faker->dateTimeBetween('-1 month', 'now');
            $tanggal_akhir = (clone $tanggal_awal)->modify('+'.rand(1, 3).' days');

            Permintaan::create([
                'user_id' => $faker->randomElement($userIds), // Ambil user_id yang valid
                'keperluan' => $faker->randomElement(['Dinas', 'Izin', 'Sakit', 'Cuti Tahunan', 'Cuti Hamil']),
                'tanggal_awal' => $tanggal_awal->format('d-m-Y'),
                'tanggal_akhir' => $tanggal_akhir->format('d-m-Y'),
                'bukti' => $faker->word . '.jpg',
                'keterangan' => $faker->sentence,
                'status' => $faker->randomElement(['pending', 'accepted', 'rejected']),
                'tanggal_permintaan' => Carbon::now()->format('d-m-Y'),
                'surat_tugas' => $faker->word . '.pdf'
            ]);
        }
    }
}
