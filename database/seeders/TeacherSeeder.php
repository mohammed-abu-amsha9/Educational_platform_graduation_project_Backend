<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;


class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            'id' => 1,
            'full_name' => 'محمود خالد عبد الله',
            'teacher_code' => 'TCH-2026-001',
            'phone_number' => '0599876543',
            'account_status' => 'active',
            'role_id' => 2,
        ]);
    }
}
