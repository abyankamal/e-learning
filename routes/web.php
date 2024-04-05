<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('daftarakun', [UserController::class, 'index'])->name('users');
    Route::get('daftarakun/tambah', [UserController::class, 'create'])->name('users.create');
    Route::post('daftarakun/simpan', [UserController::class, 'store'])->name('users.store');
    Route::get('daftarakun/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('daftarakun/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/daftarakun/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('daftarkelas', [ClassController::class, 'index'])->name('classes');
    Route::get('daftarkelas/tambah', [ClassController::class, 'create'])->name('classes.create');
    Route::post('daftarkelas/simpan', [ClassController::class, 'store'])->name('classes.store');
    Route::get('daftarkelas/edit/{class}', [ClassController::class, 'edit'])->name('classes.edit');
    Route::patch('daftarkelas/update/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/daftarkelas/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::get('daftarmatapelajaran', [CoursesController::class, 'index'])->name('courses');
    Route::get('daftarmatapelajaran/tambah', [CoursesController::class, 'create'])->name('courses.create');
    Route::post('daftarmatapelajaran/simpan', [CoursesController::class, 'store'])->name('courses.store');
    Route::get('daftarmatapelajaran/edit/{class}', [CoursesController::class, 'edit'])->name('courses.edit');
    Route::patch('daftarmatapelajaran/update/{class}', [CoursesController::class, 'update'])->name('courses.update');
    Route::delete('/daftarmatapelajaran/{class}', [CoursesController::class, 'destroy'])->name('courses.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
