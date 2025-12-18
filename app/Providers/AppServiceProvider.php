<?php

namespace App\Providers;

use App\Contracts\ImageStorage;
use App\Services\Common\ImageStorageLocal;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, ImageStorageLocal::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
