<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

      //auth
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    //auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //users
    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('/users', UserController::class);
    });
});