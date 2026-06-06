<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\DivisionPortalController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\DivisionCalendarController;

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
    $totalUnitKerja = \App\Models\Division::count();
    $totalAgenda = \App\Models\InviteMail::count();
    $completedAgenda = \App\Models\InviteMail::whereDate('hari', '<', \Carbon\Carbon::today())->count();
    $oldestDate = \App\Models\InviteMail::min('hari');
    $sejak = $oldestDate ? \Carbon\Carbon::parse($oldestDate)->year : date('Y');

    return view('welcome', compact('totalUnitKerja', 'totalAgenda', 'completedAgenda', 'sejak'));
})->name('home');

// Global public calendar page
Route::get('/home', function () {
    return view('home');
})->name('calendar');

// Division portals (per Irban)
Route::get('/division/{id}', [DivisionPortalController::class, 'show'])->name('division.portal');

// Public schedule detail
Route::get('/jadwal/{id}', [ScheduleController::class, 'show'])->name('jadwal.show');

// Public auditor profile
Route::get('/auditor/{id}', [AuditorController::class, 'show'])->name('auditor.profile');

// =============================================
// Public API Routes (Calendar Data)
// =============================================

// Calendar API for Home page — only schedules with no division (division_id IS NULL)
Route::get('/api/calendar', [CalendarController::class, 'index'])->name('api.calendar');

// Calendar API for Division Portal — only schedules belonging to the given division
Route::get('/api/calendar/division/{id}', [DivisionCalendarController::class, 'index'])->name('api.calendar.division');

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

    // ---- Auditor CRUD (JSON/AJAX) ----
    Route::get('/auditors', [AuditorController::class, 'index'])->name('auditors.index');
    Route::post('/auditors', [AuditorController::class, 'store'])->name('auditors.store');
    Route::put('/auditors/{id}', [AuditorController::class, 'update'])->name('auditors.update');
    Route::delete('/auditors/{id}', [AuditorController::class, 'destroy'])->name('auditors.destroy');
});
