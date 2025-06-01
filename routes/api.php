<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Middleware\ApiKeyMiddleware;

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('/playlists', [PlaylistController::class, 'index']);
});
