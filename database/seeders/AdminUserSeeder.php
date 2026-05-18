<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'hemanshu14433562@gmail.com'],
            [
                'name' => 'Hemanshu Kumar',
                'password' => Hash::make('Beast@123'),
                'role' => 'admin',
            ]
        );
    }
}
