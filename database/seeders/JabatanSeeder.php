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
            [
                'jabatan_id'    => 1,
                'nama_jabatan'  => 'Kepala Sekolah'
            ]
        ]);
    }
}
