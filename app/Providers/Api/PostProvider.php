<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Post\Domain\Contracts\PostRepository;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Post\Infrastructure\PostEloquentRepository;
use Src\Api\Post\Infrastructure\PostValidationRepository;

class PostProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostRepository::class, PostEloquentRepository::class);
        $this->app->bind(PostValidation::class, PostValidationRepository::class);
    }
}
