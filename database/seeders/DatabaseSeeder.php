<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Cuenta Admin',
             'lastname' => 'Ejemplo usuario',
             'phone' => '6120005678',
             'password' => '12345678',
             'email' => 'test@example.com',
         ]);
    }
}
