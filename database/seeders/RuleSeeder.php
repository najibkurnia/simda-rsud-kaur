<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rules')->insert([
            [
                'start_masuk'     => '07:00:00',
                'end_masuk'       => '08:30:00',
                'start_pulang'    => '16:00:00',
                'status'          => 'used',
            ],
        ]);
    }
}
