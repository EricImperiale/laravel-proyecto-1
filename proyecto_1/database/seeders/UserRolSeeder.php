<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            [
                'rol_id' => 1,
                'rol' => 'Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rol_id' => 2,
                'rol' => 'Usuario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
