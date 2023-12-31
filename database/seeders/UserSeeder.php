<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nip'           => '2112131',
                'nama'          => 'Neville Jeremy',
                'pangkat_id'    => 1,
                'golongan_id'   => 1,
                'jabatan_id'    => 1,
                'no_telepon'    => '08237319212',
                'role'          => 'pegawai',
                'password'      => Hash::make('neville123')
            ]
        ]);
    }
}
