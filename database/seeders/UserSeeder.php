<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Data pengguna yang sudah ada
        $users = [
            [
                'nip'           => '12345',
                'nama'          => 'Vinsensius Pokuji Hermansyah',
                'pangkat_id'    => 1,
                'golongan_id'   => 1,
                'jabatan_id'    => 1,
                'no_telepon'    => '08237319212',
                'role'          => 'pegawai',
                'alamat'        => 'Jl. Kasihan, Daerah Istimewa Yogyakarta',
                'password'      => Hash::make('pokuji')
            ],
            [
                'nip'           => '54321',
                'nama'          => 'Markus Paul Anjur',
                'pangkat_id'    => 1,
                'golongan_id'   => 1,
                'jabatan_id'    => 1,
                'no_telepon'    => '08525682192',
                'role'          => 'pegawai',
                'alamat'        => 'Jl. Satria, Sumatera Utara',
                'password'      => Hash::make('markus')
            ],
            [
                'nip'           => '220905',
                'nama'          => 'Admin Ketjeh',
                'pangkat_id'    => 1,
                'golongan_id'   => 1,
                'jabatan_id'    => 1,
                'no_telepon'    => '08215682192',
                'role'          => 'admin',
                'alamat'        => 'Jl. Pipa, Lampung',
                'password'      => Hash::make('123admin456')
            ]
        ];

        // Data pengguna tambahan yang dihasilkan oleh Faker
        for ($i = 0; $i < 17; $i++) {
            $users[] = [
                'nip'           => $faker->unique()->numerify('########'),
                'nama'          => $faker->name,
                'pangkat_id'    => $faker->numberBetween(1, 5),
                'golongan_id'   => $faker->numberBetween(1, 5),
                'jabatan_id'    => $faker->numberBetween(1, 5),
                'no_telepon'    => $faker->phoneNumber,
                'role'          => 'pegawai',
                'alamat'        => $faker->address,
                'password'      => Hash::make('password')
            ];
        }

        // Insert data ke tabel users
        DB::table('users')->insert($users);
    }
}
