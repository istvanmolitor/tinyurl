<?php

use Illuminate\Support\Facades\Route;
use Molitor\Tinyurl\Http\Controllers\Api\TinyurlController;

Route::prefix('admin/tinyurl')
    ->middleware(['api', 'auth:sanctum'])
    ->name('tinyurl.')
    ->group(function () {
        Route::resource('tinyurls', TinyurlController::class);
    });
