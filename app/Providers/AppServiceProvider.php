<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Contracts\Container;
use Src\Api\Shared\Infrastructure\LaravelContainer;
use Src\Api\Shared\Infrastructure\SimpleCommandBus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommandBus::class, SimpleCommandBus::class);
        $this->app->bind(Container::class, LaravelContainer::class);
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
