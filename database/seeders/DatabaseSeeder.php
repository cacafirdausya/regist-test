<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'ADMIN',
            'name' => 'ADMIN',
            'email' => 'ADMIN@GMAIL.COM',
            'password' => bcrypt('Admin12!'),
        ]);
    }
}
