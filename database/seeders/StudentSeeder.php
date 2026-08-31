<?php

namespace Database\Seeders;
use App\Models\Student;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('students')->insert([
            'id' => 1,
            'full_name' => 'أحمد محمد علي أبو عيشة',
            'student_code' => 'STU-2026-001',
            'grade_id' => 1,
            'section_id' => 1,
            'total_paid_amount' => '500',
            'parent_id' => '901234567',
            'parent_phone' => '0591234567',
            'parent_backup_phone' => '0561234567',
            'account_status' => 'active',
       ]);
    }
}
