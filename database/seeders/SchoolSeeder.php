<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schools')->insert([
            [
                'name' => 'Admin School',
                'address' => 'India',
                'max_staff' => 200,
                'expairy_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
