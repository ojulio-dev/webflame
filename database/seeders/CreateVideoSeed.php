<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CreateVideoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->insert([
            [
                'title' => 'Opening Tokyo Ghoul: Re season 3',
                'description' => '<3',
                'video' => '1.mp4',
                'thumbnail' => '1.jpg',
                'user_id' => '2',
                'status_id' => '1'
            ],
            [
                'title' => 'Black Clover - Opening 7 (HD)',
                'description' => '<3',
                'video' => '2.mp4',
                'thumbnail' => '2.jpg',
                'user_id' => '1',
                'status_id' => '1'
            ],
            [
                'title' => 'Black Clover Opening 9 | RIGHT NOW',
                'description' => '<3',
                'video' => '3.mp4',
                'thumbnail' => '3.jpg',
                'user_id' => '2',
                'status_id' => '1'
            ],
            [
                'title' => 'Black Clover - Opening 3 | Black Rover',
                'description' => '<3',
                'video' => '4.mp4',
                'thumbnail' => '4.jpg',
                'user_id' => '1',
                'status_id' => '1'
            ]
        ]);
    }
}
