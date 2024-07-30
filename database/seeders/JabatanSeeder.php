<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('jabatan')->insert([
            ['nama_jabatan'  => 'Dokter Gigi'],
            ['nama_jabatan'  => 'Staf Subbag Perencanaan dan Program'],
            ['nama_jabatan'  => 'Staf Poli'],
            ['nama_jabatan'  => 'Staf Poli Umum'],
            ['nama_jabatan'  => 'Staf Poli Kebidanan'],
            ['nama_jabatan'  => 'Staf Poli Gigi'],
            ['nama_jabatan'  => 'Staf BPJS'],
            ['nama_jabatan'  => 'Staf Keungan'],
            ['nama_jabatan'  => 'Staf Subbag UP'],
            ['nama_jabatan'  => 'Staf Kasubbid SDN dan DIKLAT'],
            ['nama_jabatan'  => 'Staf Bidang Pelayanan'],
            ['nama_jabatan'  => 'Staf Bendahara Barang'],
            ['nama_jabatan'  => 'Staf Bidang Penunjang'],
            ['nama_jabatan'  => 'Staf Rekam Medik'],

        ]);
    }
}
