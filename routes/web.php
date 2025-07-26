<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenValidatorMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/auth/register');

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/register', [AuthController::class, 'index'])->name('index');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/details/{token}', [AuthController::class, 'details'])->name('details');
    Route::get('/invalid-token', [AuthController::class, 'invalidToken'])->name('invalid-token');

    Route::post('/reset-token/{token}', [AuthController::class, 'resetToken'])->name('reset-token');
    Route::post('/deactivate-token/{token}', [AuthController::class, 'deactivateToken'])->name('deactivate-token');
});

Route::prefix('/dashboard')
    ->middleware(TokenValidatorMiddleware::class)
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::post('/play', [DashboardController::class, 'play'])->name('play');
        Route::get('/history', [DashboardController::class, 'history'])->name('history');
});
