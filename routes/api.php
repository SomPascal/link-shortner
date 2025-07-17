<?php

use App\Http\Controllers\Api\UrlShortenerController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::name('short_url.')->prefix('shorten')->group(function (){        
        Route::post('/', [UrlShortenerController::class, 'shorten'])
        ->name('make');
    
        Route::get('stats/{short_code}', [UrlShortenerController::class, 'stats'])
        ->name('stats');
    });
});