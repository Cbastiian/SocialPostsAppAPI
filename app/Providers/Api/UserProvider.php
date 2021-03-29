<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\User\Infrastructure\UserEloquentRepository;
use Src\Api\User\Infrastructure\UserValidationRepository;

class UserProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepository::class, UserEloquentRepository::class);
        $this->app->bind(UserValidation::class, UserValidationRepository::class);
    }
}
