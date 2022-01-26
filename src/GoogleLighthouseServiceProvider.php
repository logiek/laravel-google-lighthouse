<?php

declare(strict_types=1);

namespace Logiek\GoogleLighthouse;

use Illuminate\Support\ServiceProvider;

class GoogleLighthouseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/google-lighthouse.php' => config_path('google-lighthouse.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/google-lighthouse.php', 'google-lighthouse');
    }
}
