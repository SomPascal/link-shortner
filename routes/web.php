<?php

use App\Constants\Regex;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\web\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('{short_code}', [RedirectController::class, 'redirect'])
->where('short_code', Regex::SHORTEN_URL_CODE)
->name('redirect');