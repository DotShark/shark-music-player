<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ApiKeyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\IsAdmin;

Route::get('/welcolme', function () {
    return Inertia::render('Welcome');
})->name('welcolme');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tracks')->name('tracks.')->group(function () {
    Route::get('/', [TrackController::class, 'index'])->name('index');

    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('create', [TrackController::class, 'create'])->name('create');
        Route::post('/', [TrackController::class, 'store'])->name('store');
        Route::get('{track}/edit', [TrackController::class, 'edit'])->name('edit');
        Route::patch('{track}', [TrackController::class, 'update'])->name('update');
        Route::delete('{track}', [TrackController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('playlists')->name('playlists.')->middleware('auth')->group(function () {
    Route::get('/', [PlaylistController::class, 'index'])->name('index');
    Route::get('create', [PlaylistController::class, 'create'])->name('create');
    Route::post('/', [PlaylistController::class, 'store'])->name('store');
    Route::get('{playlist}', [PlaylistController::class, 'show'])->name('show');
    Route::delete('{playlist}', [PlaylistController::class, 'destroy'])->name('destroy');
});

Route::prefix('api-keys')->name('api-keys.')->middleware('auth')->group(function () {
    Route::get('/', [ApiKeyController::class, 'index'])->name('index');
    Route::get('create', [ApiKeyController::class, 'create'])->name('create');
    Route::post('/', [ApiKeyController::class, 'store'])->name('store');
    Route::delete('{apiKey}', [ApiKeyController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
