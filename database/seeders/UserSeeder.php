<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@test.com',
                'phone' => '1234567890',
                'role_id' => 1,
                'school_id' => 1,
                'gender' => 'male',
                'password' => 'password123',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'phone' => '1234567899',
                'role_id' => 2,
                'school_id' => 1,
                'gender' => 'male',
                'password' => 'password123',
            ],
        ]);
    }
}
