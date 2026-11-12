<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Data pengaduan
    Route::resource('complaints', ComplaintController::class);

    // Manajemen pengguna
    Route::resource('users', UserController::class)
        ->except(['show']);

});

require __DIR__.'/auth.php';
