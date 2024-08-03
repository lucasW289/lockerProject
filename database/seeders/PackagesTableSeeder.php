<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade

class PackagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('packages')->insert([
            [
                'name' => 'Standard',
                'price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'price' => 35.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
