<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Seller',
                'slug' => 'seller',
                'description' => 'Sales operations',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'name' => 'Collector',
                'slug' => 'collector',
                'description' => 'Payments and collections',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
