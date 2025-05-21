<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('roles')->insert([
            [
                'role_name' => 'Super Admin',
                'school_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Admin',
                'school_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
