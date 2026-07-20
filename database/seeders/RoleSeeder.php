<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan db:seed --class=RoleSeeder
        DB::table('roles')->insert(
            [
                'id' => 1,
                'role_name' => 'ادمن',
            ]
        );
        DB::table('roles')->insert(
           [
                'id' => 2,
                'role_name' => 'معلم',
            ]
        );
        DB::table('roles')->insert(
            [
                'id' => 3,
                'role_name' => 'طالب',
            ]
        );
    }
}


