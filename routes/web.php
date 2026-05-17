<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisionPortalController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =============================================
// Public Routes (No Login Required)
// =============================================

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Global public calendar
Route::get('/home', function () {
    return view('home');
})->name('calendar');

// Division portals (per Irban)
Route::get('/division/{id}', [DivisionPortalController::class, 'show'])->name('division.portal');

// Public schedule detail
Route::get('/jadwal/{id}', [ScheduleController::class, 'show'])->name('jadwal.show');

// =============================================
// Authentication Routes
// =============================================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Hidden admin registration
Route::match(['get', 'post'], '/register-admin-secret', [AuthController::class, 'registerAdminSecret'])
    ->name('register.secret');

// =============================================
// Protected Admin Routes (Middleware: auth)
// =============================================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard (list all schedules)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Create new surat
    Route::get('/surat/create', [AdminController::class, 'create'])->name('surat.create');
    Route::post('/surat', [AdminController::class, 'store'])->name('surat.store');

    // Edit surat
    Route::get('/surat/{id}/edit', [AdminController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{id}', [AdminController::class, 'update'])->name('surat.update');

    // Delete surat
    Route::delete('/surat/{id}', [AdminController::class, 'destroy'])->name('surat.destroy');
});
