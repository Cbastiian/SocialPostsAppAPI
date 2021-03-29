<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Domain\Contracts\SharedValidations;
use Src\Api\Shared\Infrastructure\SharedEloquentRepository;
use Src\Api\Shared\Infrastructure\SharedValidationRepository;

class SharedProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SharedRepository::class, SharedEloquentRepository::class);
        $this->app->bind(SharedValidations::class, SharedValidationRepository::class);
    }
}
