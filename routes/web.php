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

// Schedule CRUD Routes
Route::resource('schedules', ScheduleController::class);

// Division Portal Route
Route::get('/division/{id}', [DivisionPortalController::class, 'show'])->name('division.portal');
