<?php

namespace App\Providers;

use App\Services\NewsService;
use App\Services\NewsServiceInterface;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            NewsServiceInterface::class,
            NewsService::class
        );
    }
}
