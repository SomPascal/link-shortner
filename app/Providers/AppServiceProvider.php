<?php

namespace App\Providers;

use App\Constants\Throttler;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->setRateLimiters();
    }

    protected function setRateLimiters(): void
    {
        $key = Auth::check() ? Auth::user()->id : request()->ip();

        RateLimiter::for('shortner', function () use ($key) {
            return Limit::perMinute(Throttler::SHORTNER_PER_MINUTE)->by($key);
        });

        RateLimiter::for('redirect', function () use($key) {
            return Limit::perMinute(Throttler::REDIRECTION_BY_MINUTE)->by($key);
        });
    }
}
