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
            ['nama_golongan'     => 'Ia'],
            ['nama_golongan'     => 'Ib'],
            ['nama_golongan'     => 'Ic'],
            ['nama_golongan'     => 'Id'],
            ['nama_golongan'     => 'IIa'],
            ['nama_golongan'     => 'IIb'],
            ['nama_golongan'     => 'IIc'],
            ['nama_golongan'     => 'IId'],
            ['nama_golongan'     => 'IIIa'],
            ['nama_golongan'     => 'IIIb'],
            ['nama_golongan'     => 'IIIc'],
            ['nama_golongan'     => 'IIId'],
            ['nama_golongan'     => 'IVa'],
            ['nama_golongan'     => 'IVb'],
            ['nama_golongan'     => 'IVc'],
            ['nama_golongan'     => 'IVd'],
            ['nama_golongan'     => 'IVe'],

        ]);
    }
}
