<?php

use Illuminate\Support\Facades\Route;

Route::view('admin_control_panel','admin.control_panel')->name('admin_control_panel');
Route::view('admin_students','admin.students')->name('admin_students');
Route::view('admin_teachers','admin.teachers')->name('admin_teachers');
Route::view('admin_fees','admin.fees')->name('admin_fees');
Route::view('admin_role_permistions','admin.role_permistions')->name('admin_role_permistions');
Route::view('login','login')->name('login');

Route::view('teacher_control_panel','teacher.control_panel')->name('teacher_control_panel');
Route::view('teacher_lessons','teacher.lessons')->name('teacher_lessons');
Route::view('teacher_attendance','teacher.attendance')->name('teacher_attendance');
Route::view('teacher_questions','teacher.questions')->name('teacher_questions');
Route::view('teacher_test_generator','teacher.test_generator')->name('teacher_test_generator');
Route::view('teacher_exams_manage','teacher.exams_manage')->name('teacher_exams_manage');
Route::view('teacher_tasks_manage','teacher.tasks_manage')->name('teacher_tasks_manage');
Route::view('teacher_chats','teacher.chats')->name('teacher_chats');

Route::view('student_control_panel','student.control_panel')->name('student_control_panel');
Route::view('student_materials','student.materials')->name('student_materials');
Route::view('student_tests','student.tests')->name('student_tests');
Route::view('student_tasks_and_duties','student.tasks_and_duties')->name('student_tasks_and_duties');
Route::view('student_chats','student.chats')->name('student_chats');
Route::view('student_sync','student.sync')->name('student_sync');

