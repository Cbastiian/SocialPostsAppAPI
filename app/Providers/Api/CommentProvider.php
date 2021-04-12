<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Comment\Domain\Contracts\CommentRepository;
use Src\Api\Comment\Infrastructure\CommentEloquentRepository;

class CommentProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CommentRepository::class, CommentEloquentRepository::class);
    }
}
