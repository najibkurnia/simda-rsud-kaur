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
                'nama'          => 'Neville Jeremy',
                'pangkat_id'    => 1,
                'golongan_id'   => 1,
                'jabatan_id'    => 1,
                'no_telepon'    => '08215682192',
                'role'          => 'admin',
                'alamat'        => 'Jl. Pipa, Lampung',
                'password'      => Hash::make('123admin456')
            ]
        ]);
    }
}
