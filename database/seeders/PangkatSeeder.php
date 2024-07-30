<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pangkat')->insert([
            ['nama_pangkat'  => 'Juru Muda'],
            ['nama_pangkat'  => 'Juru Muda Tk I'],
            ['nama_pangkat'  => 'Juru'],
            ['nama_pangkat'  => 'Juru Tk I'],
            ['nama_pangkat'  => 'Pengatur Muda'],
            ['nama_pangkat'  => 'Pengatur Muda Tk I'],
            ['nama_pangkat'  => 'Pengatur'],
            ['nama_pangkat'  => 'Pengatur Tk I'],
            ['nama_pangkat'  => 'Penata Muda'],
            ['nama_pangkat'  => 'Penata Muda Tk I'],
            ['nama_pangkat'  => 'Penata'],
            ['nama_pangkat'  => 'Penata Tk I'],
            ['nama_pangkat'  => 'Pembina'],
            ['nama_pangkat'  => 'Pembina Tk I'],
            ['nama_pangkat'  => 'Pembina Muda'],
            ['nama_pangkat'  => 'Pembina Madya'],
            ['nama_pangkat'  => 'Pembina Utama'],
        ]);
    }
}
