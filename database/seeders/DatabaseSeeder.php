<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'phone' => '1234567890',
            'address' => 'Admin Street 123',
            'role' => 'admin',
        ]);

        // Crear usuario normal (guest)
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => Hash::make('guest123'),
            'phone' => '0987654321',
            'address' => 'Guest Avenue 456',
            'role' => 'guest',
        ]);

        // Opcional: Crear más usuarios de prueba con una fábrica
        User::factory(8)->create();
    }
}
