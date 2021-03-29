<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Infrastructure\SharedEloquentRepository;

class SharedProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SharedRepository::class, SharedEloquentRepository::class);
    }
}
