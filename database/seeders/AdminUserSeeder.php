<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Add this import

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Check if the admin user already exists
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            // Create the admin user
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminPassword'), // Hash the password
                'role_id' => 1, // Assuming 1 is the role_id for admin
            ]);
        }
    }
}
