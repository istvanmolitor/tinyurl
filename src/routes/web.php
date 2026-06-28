<?php

use Illuminate\Support\Facades\Route;
use Molitor\Tinyurl\Http\Controllers\Web\RedirectController;

Route::get('/tinyurl/{slug}', RedirectController::class)->name('tinyurl.redirect');
