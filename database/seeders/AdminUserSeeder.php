<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Use updateOrCreate so it doesn't crash if you run the seeder twice
        User::updateOrCreate(
            ['email' => 'admin@makabataan.gov.ph'], // Check if this email exists
            [
                'name' => 'SK Chairman Admin',
                'password' => Hash::make('password123'), // Change this to a secure password
                'role' => 'admin',
                'email_verified_at' => now(), // Automatically verify their email
            ]
        );
    }
}
