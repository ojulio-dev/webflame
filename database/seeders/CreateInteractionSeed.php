<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CreateInteractionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('interactions')->insert([
            [
                'name' => 'Ameeei',
                'icon' => '1.png'
            ],
            [
                'name' => 'Ha Ha Ha',
                'icon' => '2.png'
            ],
            [
                'name' => 'Depressão',
                'icon' => '3.png'
            ],
            [
                'name' => 'Grrrr',
                'icon' => '4.png'
            ]
        ]);
    }
}
