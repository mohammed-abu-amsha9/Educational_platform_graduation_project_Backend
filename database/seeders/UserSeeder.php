<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan db:seed --class=UserSeeder
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'محمد اياد يونس ابو عمشة',
            'password' => Hash::make('1'), // تشفير كلمة المرور
            'role_id' => 1,
        ]);
    }
}
