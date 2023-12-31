<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('golongan')->insert([
            [
                'golongan_id'       => 1,
                'nama_golongan'     => 'Pembina (IV)'
            ]
        ]);
    }
}
