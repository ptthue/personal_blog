<?php

namespace App\Providers;

use App\Contracts\ImageStorage;
use App\Infrastructure\ConfigurableImageUploader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, ConfigurableImageUploader::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
