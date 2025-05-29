<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
            'name' => 'Admin',
            'password' => bcrypt('password123'),
            'is_admin' => 1,
        ]);
    }
}
