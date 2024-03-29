<?php

namespace App\Providers;

use App\Interfaces\ActivityRepositoryInterface;
use App\Repositories\ActivityRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ActivityRepositoryInterface::class, ActivityRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
