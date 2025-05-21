<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcolme', function () {
    return Inertia::render('Welcome');
})->name('welcolme');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tracks')->name('tracks.')->group(function () {
    Route::get('/', [TrackController::class, 'index'])->name('index');
    Route::get('/create', [TrackController::class, 'create'])->name('create');
    Route::post('/', [TrackController::class, 'store'])->name('store');
    Route::get('/{track}/edit', [TrackController::class, 'edit'])->name('edit');
    Route::patch('/{track}', [TrackController::class, 'update'])->name('update');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
