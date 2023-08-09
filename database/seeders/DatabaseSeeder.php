<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => env('ADMIN_USER','admin'),
             'email' => 'test@example.com',
             'password' => Hash::make(env('ADMIN_PASSWORD'))
         ]);
    }
}
