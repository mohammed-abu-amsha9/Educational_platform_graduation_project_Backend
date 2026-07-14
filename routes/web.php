<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceLogController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\materialContentController;
use App\Http\Controllers\PermistionController;
use App\Http\Controllers\QuestionBankController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\StudentExamResultController;
use App\Http\Controllers\StudentMonthlyFeeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\syncController;
use App\Http\Controllers\TeacherController;
use App\Models\permistion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');
Route::view('admin_control_panel', 'admin.control_panel')->name('admin');

Route::view('teacher_control_panel', 'teacher.control_panel')->name('teacher_control_panel');
Route::view('teacher_lessons', 'teacher.lessons')->name('teacher_lessons');
Route::view('teacher_attendance', 'teacher.attendance')->name('teacher_attendance');
Route::view('teacher_questions', 'teacher.questions')->name('teacher_questions');
Route::view('teacher_test_generator', 'teacher.test_generator')->name('teacher_test_generator');
Route::view('teacher_exams_manage', 'teacher.exams_manage')->name('teacher_exams_manage');
Route::view('teacher_tasks_manage', 'teacher.tasks_manage')->name('teacher_tasks_manage');
Route::view('teacher_chats', 'teacher.chats')->name('teacher_chats');

Route::view('student_control_panel', 'student.control_panel')->name('student_control_panel');
Route::view('student_materials', 'student.materials')->name('student_materials');
Route::view('student_tests', 'student.tests')->name('student_tests');
Route::view('student_tasks_and_duties', 'student.tasks_and_duties')->name('student_tasks_and_duties');
Route::view('student_chats', 'student.chats')->name('student_chats');
Route::view('student_sync', 'student.sync')->name('student_sync');

Route::prefix('admin')->group(function () {
    Route::resource('dashboard', dashboardController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('permistions', PermistionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('fees', FeeController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::put('students/edit-class/{student}', [StudentController::class, 'editClassStudent'])->name('editClassStudent');
    Route::put('students/edit-fees/{student}', [StudentController::class, 'editFeesStudent'])->name('editFeesStudent');
});
Route::prefix('teacher')->group(function () {
    Route::resource('lessons', LessonController::class);
    Route::resource('attendance', AttendanceLogController::class);
    Route::resource('questions', QuestionBankController::class);
    // 1. مسار مخصص لجلب الأسئلة عبر AJAX (يجب أن يكون قبل الـ resource)
    Route::post('exams/fetch-questions', [ExamController::class, 'fetchQuestions'])->name('exams.fetch-questions');
    Route::resource('exams', ExamController::class);



    Route::resource('assignments', AssignmentController::class);
    
});

Route::prefix('student')->group(function () {
    Route::resource('studentExams', StudentExamController::class);
    Route::resource('studentExamResults', StudentExamResultController::class);
    Route::resource('materialContents', materialContentController::class);
    Route::resource('syncs', syncController::class);
});

Route::get('/api/get-exam-questions/{id}', [StudentExamController::class, 'getExamQuestions']);