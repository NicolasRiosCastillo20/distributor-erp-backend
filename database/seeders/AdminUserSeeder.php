<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();

        $admin = User::create([
            'name' => 'ERP Administrator',
            'email' => 'admin@erp.com',
            'password' => 'password', // In production, use a secure password and consider using environment variables
            'status' => true,
        ]);

        $admin->roles()->attach($adminRole->id);
    }
}
