<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CreateVideoStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('video_status')->insert([
            [
                'name' => 'public',
                'color' => '#00C851'
            ],
            [
                'name' => 'private',
                'color' => '#ff4444'
            ],
            [
                'name' => 'pending',
                'color' => '#f7cb73'
            ],
            [
                'name' => 'canceled',
                'color' => '#C20000'
            ]
        ]);
    }
}
