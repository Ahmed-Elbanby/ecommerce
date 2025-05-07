<?php

use App\Http\Controllers\ProfileController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StudentController;
use App\Models\Section;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/login_p', function () {
//     return view('auth.login');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tables', function () {
    return view('tables');
})->name('tables');

Route::resource('/faculty', FacultyController::class);
Route::resource('/classroom', ClassroomController::class);
Route::resource('/section', SectionController::class);
Route::get('/classroom/{facultyId}', [SectionController::class, 'getClassrooms'])->name('get.classrooms');
Route::get('/classrooms/{faculty_id}', [ClassroomController::class, 'getClassrooms'])->name('classrooms.get');
Route::get('/sections/{classroomId}', function ($classroomId) {
    $sections = Section::where('classroom_id', $classroomId)->get();
    return response()->json($sections);
});

Route::get('livewire', function(){ return view('livewire-test');});

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::resource('doctor', DoctorController::class);

Route::resource('student', StudentController::class);
Route::resource('students', StudentController::class);

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::resource('student', StudentController::class);

// Explicit route for "show" (singular)
Route::get('/student/{student}', [StudentController::class, 'show'])
     ->name('student.show'); // Singular name

// // OR keep resource routes but customize the name:
// Route::resource('student', StudentController::class)->names([
//     'show' => 'student.show', // Force singular
// ]);

Route::get('/student/{student}/download', [StudentController::class, 'downloadImage'])
    ->name('student.download');


// Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
// Route::post('/student/{student}/upload_attachment', [StudentController::class, 'Upload_attachment'])->name('student.upload_attachment');
// Route::get('/download_attachment/{studentsname}/{filename}', [StudentController::class, 'Download_attachment'])->name('student.download');


Route::post('/students/{student}/attachments', [StudentController::class, 'Upload_attachment'])
     ->name('student.upload_attachment');

Route::delete('/students/{student}/attachments/{image}', [StudentController::class, 'destroyAttachment'])
     ->name('student.destroy_attachment');

Route::get('/students/{student}/attachments/{image}/download', [StudentController::class, 'downloadAttachment'])
     ->name('student.download_attachment');