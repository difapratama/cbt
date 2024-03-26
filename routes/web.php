<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ExamMastersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'can:create role')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('master/roles', RoleController::class);
    Route::resource('master/categories', CategoriesController::class);
    Route::resource('master/students', StudentsController::class);

    Route::resource('master/exam-masters', ExamMastersController::class);
    Route::group(['prefix' => 'master/exam-masters/{exam_master}/questions', 'as' => 'exam-questions.'], function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::get('create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
    });
});

require __DIR__ . '/auth.php';
