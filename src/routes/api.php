<?php

use Illuminate\Support\Facades\Route;
use Molitor\Tinyurl\Http\Controllers\Api\TinyurlController;

Route::prefix('admin/tinyurl')
    ->middleware(['api', 'auth:sanctum'])
    ->name('tinyurl.')
    ->group(function () {
        Route::post('quick-create', [TinyurlController::class, 'quickCreate'])->name('quick-create');
        Route::resource('tinyurls', TinyurlController::class);
    });
