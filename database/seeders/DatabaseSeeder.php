<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();

        User::factory()->create([
            'name' => 'Moyo Shoyo',
            'username' => 'moyoshoyo',
            'email' => 'juliocesarjc025@gmail.com',
            'password' => Hash::make('1212')
        ]);
    }
}
