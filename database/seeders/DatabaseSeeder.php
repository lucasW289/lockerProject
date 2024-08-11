<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles with updateOrInsert to avoid duplicate entry issues
        $roles = [
            ['id' => 1, 'name' => 'Primary Admin'],
            ['id' => 2, 'name' => 'Administrator'],
            ['id' => 3, 'name' => 'User']
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['id' => $role['id']], // Match on the primary key
                ['name' => $role['name']] // Update if already exists
            );
        }

        // Call other seeders
        $this->call(AdminUserSeeder::class);
        $this->call([
            PackagesTableSeeder::class, // Add your PackagesTableSeeder here
        ]);
    }
}
