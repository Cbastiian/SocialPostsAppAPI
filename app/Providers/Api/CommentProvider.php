<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Comment\Domain\Contracts\CommentRepository;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Comment\Infrastructure\CommentEloquentRepository;
use Src\Api\Comment\Infrastructure\CommentValidationRepository;

class CommentProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CommentRepository::class, CommentEloquentRepository::class);
        $this->app->bind(CommentValidation::class, CommentValidationRepository::class);
    }
}
