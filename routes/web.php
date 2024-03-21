<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
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
});
// Route::controller(RoleController::class)->group(function(){
//     Route::get('/roles', 'index')->middleware('can:read role');
//     Route::get('/roles/create', 'create')->middleware('can:create role');
// });

require __DIR__ . '/auth.php';
