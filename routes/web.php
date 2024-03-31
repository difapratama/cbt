<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamMastersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterPageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('master/roles', RoleController::class);
    Route::resource('master/categories', CategoriesController::class);
    Route::resource('master/students', StudentsController::class);

    Route::resource('master/exam-masters', ExamMastersController::class);
    Route::match(['get', 'post'], '/exam', [ExamMastersController::class, 'showExamPage'])->name('exam');

    Route::group(['prefix' => 'master/exam-masters/{exam_master}/questions', 'as' => 'exam-questions.'], function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::get('/create', [QuestionController::class, 'create'])->name('create');
        Route::post('/', [QuestionController::class, 'store'])->name('store');
        Route::get('/{exam_question}/edit', [QuestionController::class, 'edit'])->name('edit');
        Route::put('/{exam_question}', [QuestionController::class, 'update'])->name('update');
        Route::delete('/{exam_question}', [QuestionController::class, 'destroy'])->name('destroy');
    });
});

Route::match(['get', 'post'], '/public/reg/{exam_master}', [RegisterPageController::class, 'show'])->name('register-exam');

require __DIR__ . '/auth.php';
