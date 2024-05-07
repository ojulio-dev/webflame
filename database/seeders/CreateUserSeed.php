<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Moyo Shoyo',
                'username' => 'moyoshoyo',
                'email' => 'juliocesarjc025@gmail.com',
                'password' => Hash::make('123123'),
                'icon' => '1.jpg',
                'is_admin' => 1
            ],
            [
                'name' => 'Menino Maluquinho',
                'username' => 'meninomaluquinho',
                'email' => 'meninomaluquinho@gmail.com',
                'password' => Hash::make('123123'),
                'icon' => '2.jpg',
                'is_admin' => 0
            ]
        ]);
    }
}
