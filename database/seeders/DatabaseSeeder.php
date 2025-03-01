<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Models\User::factory()->unverified()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'remember_token' => null,
        ]);
    }
}
