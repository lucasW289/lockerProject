<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Primary Admin'],
            ['id' => 2, 'name' => 'Administrator'],
            ['id' => 3, 'name' => 'User'],
        ]);

        $this->call([
            PackagesTableSeeder::class, // Add your PackagesTableSeeder here
        ]);
    }
}
