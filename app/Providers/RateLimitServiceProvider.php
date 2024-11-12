<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        RateLimiter::for(
            name: 'api',
            callback: static fn () => Limit::perMinute(
                maxAttempts: 60,
            )
        );

        RateLimiter::for(
            name: 'auth',
            callback: static fn () => Limit::perMinute(
                maxAttempts: 5,
            )
        );
    }
}
