<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach (['login', 'signup'] as $limiter) {
            RateLimiter::for($limiter, function (Request $request): Limit {
                $key = Str::transliterate(
                    $request->string('email')->lower().'|'.$request->ip(),
                );

                return Limit::perMinute(5)->by($key);
            });
        }
    }
}
