<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('roles')->insert([
            'role_name' => 'Developer',
            'modules' => json_encode([1,2,3,4]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

              DB::table('roles')->insert([
            'role_name' => 'User',
            'modules' => json_encode([]),  // Empty array for now, can add specific modules later
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
