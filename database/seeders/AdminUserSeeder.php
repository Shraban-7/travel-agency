<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@travelagency.test'],
            [
                'name' => 'Admin',
                'phone' => '+8801712345678',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@travelagency.test'],
            [
                'name' => 'Staff',
                'phone' => '+8801812345678',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
    }
}
