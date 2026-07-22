<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\AttendanceLogController;
use App\Http\Controllers\Auth\authcontroller;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dashboardStudentController;
use App\Http\Controllers\dashboardTeacherController;
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
use App\Http\Controllers\viewTasks;
use App\Http\Controllers\viewTasksController;
use App\Models\permistion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login')
        ->middleware('guest');
    Route::post('/login', [authcontroller::class, 'login'])->name('auth.login')->middleware('throttle:login');
});

Route::prefix('student')->middleware(['auth', 'role:3'])->group(function () {
    Route::resource('dashboardStudent', dashboardStudentController::class);
    Route::resource('studentExams', StudentExamController::class);
    Route::resource('materialContents', materialContentController::class);
    Route::resource('syncs', syncController::class);
});


Route::prefix('teacher')->middleware(['auth', 'role:2'])->group(function () {
    Route::resource('dashboardTeacher', dashboardTeacherController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('attendance', AttendanceLogController::class);
    Route::resource('questions', QuestionBankController::class);
    // 1. مسار مخصص لجلب الأسئلة عبر AJAX (يجب أن يكون قبل الـ resource)
    Route::post('exams/fetch-questions', [ExamController::class, 'fetchQuestions'])->name('exams.fetch-questions');
    Route::resource('exams', ExamController::class);
    Route::resource('assignments', AssignmentController::class);
    Route::get('gradingassignments', [viewTasksController::class, 'Grading_and_monitoring_assignments'])->name('gradingassignments');
    Route::get('studentsListView', [viewTasksController::class, 'studentsListView'])->name('studentsListView');
    Route::get('reviewAndCorrection/{id}', [viewTasksController::class, 'reviewAndCorrection'])->name('reviewAndCorrection');
    Route::resource('studentExamResults', StudentExamResultController::class);
});

Route::prefix('student')->middleware(['auth', 'role:2,3'])->group(function () {
    Route::resource('chats', ChatRoomController::class);
    Route::resource('assignmentSubmissions', AssignmentSubmissionController::class);
});

Route::prefix('admin')->middleware(['auth', 'role:1'])->group(function () {
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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
