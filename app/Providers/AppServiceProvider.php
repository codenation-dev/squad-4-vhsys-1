<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\LogRepositoryInterface',
            'App\Repositories\LogRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ExclusionRepositoryInterface',
            'App\Repositories\ExclusionRepository'
        );

        $this->app->bind(
            'App\Services\Contracts\LogServiceInterface',
            'App\Services\LogService'
        );

        $this->app->bind(
            'App\Services\Contracts\ExclusionServiceInterface',
            'App\Services\ExclusionService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
