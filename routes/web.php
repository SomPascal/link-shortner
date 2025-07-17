<?php

use App\Constants\Regex;
use App\Http\Controllers\web\AccountController;
use App\Http\Controllers\web\Auth\LoginController;
use App\Http\Controllers\web\Auth\LogoutController;
use App\Http\Controllers\web\Auth\RegisterController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\RedirectController;
use App\Http\Controllers\web\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'doLogin'])->name('doLogin');

    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register', [RegisterController::class, 'doRegister'])->name('doRegister');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('account', [AccountController::class, 'show'])->name('account');
    Route::get('links', );
});

Route::name('url.')->group(function () {
    Route::get('url', [UrlController::class, 'list'])->name('list');

    Route::get('{short_code}', [RedirectController::class, 'redirect'])
    ->where('short_code', Regex::SHORTEN_URL_CODE)
    ->name('redirect');
});
