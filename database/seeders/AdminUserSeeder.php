<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin2',
            'email' => 'admin2@dawan.fr',
            'password' => Hash::make('admin2025'),
            'roles' => json_encode(['ROLE_ADMIN', 'ROLE_USER']),
        ]);
    }
}
