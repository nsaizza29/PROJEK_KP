<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\JenisKlaimController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Protected routes: auth + approved
| Guest routes: auth pages
| Public: not-approved
|
*/

Route::get('/not-approved', fn() => view('not_approved'))->name('not-approved');

/*
| Protected routes (login + approved)
*/
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User management (controller enforces permissions)
    Route::resource('users', UserController::class);
    Route::post('users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('users/{user}/reject',  [UserController::class, 'reject'])->name('users.reject');
    Route::get('users-download', [UserController::class, 'download'])->name('users.download');

    // Nasabah
    Route::resource('nasabah', NasabahController::class);
    Route::get('nasabah-download', [NasabahController::class, 'download'])->name('nasabah.download');
    Route::patch('nasabah/update-status/{id}', [NasabahController::class, 'updateStatus'])->name('nasabah.update-status');
    Route::post('nasabah/{id}/toggle-status', [NasabahController::class, 'toggleStatus'])->name('nasabah.toggle-status');
    Route::post('nasabah/{id}/toggle-check', [NasabahController::class, 'toggleCheck'])->name('nasabah.toggle-check');

    // Jenis klaim
    Route::resource('jenis-klaim', JenisKlaimController::class);

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Logout / user profile tambahan
    Route::get('logout', [SessionsController::class, 'destroy'])->name('logout');
    Route::get('user-profile', [InfoUserController::class, 'create'])->name('user-profile.create');
    Route::post('user-profile', [InfoUserController::class, 'store'])->name('user-profile.store');
});

/*
| Guest routes (register / login / password reset)
*/
Route::middleware('guest')->group(function () {
    
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

    Route::get('login', [SessionsController::class, 'create'])->name('login');
    Route::post('session', [SessionsController::class, 'store'])->name('session.store');

    Route::get('login/forgot-password', [ResetController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [ResetController::class, 'sendEmail'])->name('password.email');

    Route::get('reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});