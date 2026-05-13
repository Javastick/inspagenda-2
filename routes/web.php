<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DivisionPortalController;

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
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Secret Admin Registration Route
Route::match(['get', 'post'], '/register-admin-secret', [AuthController::class, 'registerAdminSecret']);

// Home Route
Route::get('/home', function () {
    $todaySchedules = \App\Models\InviteMail::whereDate('hari', \Carbon\Carbon::today())->get();
    $upcomingSchedules = \App\Models\InviteMail::whereDate('hari', '>', \Carbon\Carbon::today())
                                               ->whereDate('hari', '<=', \Carbon\Carbon::today()->addDays(2))
                                               ->get();
    return view('home', compact('todaySchedules', 'upcomingSchedules'));
})->name('home');

// Schedule CRUD Routes (Admin Dashboard)
// Note: index now returns admin.dashboard view
Route::resource('admin/schedules', ScheduleController::class)->names([
    'index' => 'schedules.index',
    'store' => 'schedules.store',
    'show' => 'schedules.show',
    'update' => 'schedules.update',
    'destroy' => 'schedules.destroy',
]);
// Alias for /admin/dashboard to schedules.index
Route::get('/admin/dashboard', [ScheduleController::class, 'index'])->name('admin.dashboard');

// Division Portal Route
Route::get('/portal/division/{id}', [DivisionPortalController::class, 'show'])->name('division.portal');
