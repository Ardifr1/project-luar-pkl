<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'pengguna',
            'username' => 'pengguna1',
            'password' => bcrypt('pengguna123'),
            'role' => 'guru',
            'status' => 'approved',

        ]);
        User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'status' => 'approved',

        ]);
    }
}
