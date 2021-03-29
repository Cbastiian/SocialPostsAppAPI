<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Auth\Domain\Contracts\AuthRepository;
use Src\Api\Auth\Domain\Contracts\AuthValidation;
use Src\Api\Auth\Infrastructure\AuthEloquentRepository;
use Src\Api\Auth\Infrastructure\AuthValidationRepository;

class AuthProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthRepository::class, AuthEloquentRepository::class);
        $this->app->bind(AuthValidation::class, AuthValidationRepository::class);
    }
}
