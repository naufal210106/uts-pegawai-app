<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Halaman utama (publik)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'    => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

    Route::get('/info-kepegawaian', fn () => Inertia::render('InfoKepegawaian'))
        ->name('info.kepegawaian');

    // CRUD pegawai: employees.index, create, store, edit, update, destroy
    Route::resource('employees', EmployeeController::class)->except(['show']);
});

// Route login, register, logout, dll.
require __DIR__ . '/auth.php';