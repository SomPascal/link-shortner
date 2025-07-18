<?php

use App\Http\Controllers\Api\UrlShortenerController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::name('short_url.')->middleware('auth:sanctum')->prefix('shorten')->group(function (){        
        Route::post('/', [UrlShortenerController::class, 'shorten'])
        ->middleware('throttle:shortner')
        ->name('make');
    
        Route::get('stats/{short_code}', [UrlShortenerController::class, 'stats'])
        ->name('stats');
    });
});