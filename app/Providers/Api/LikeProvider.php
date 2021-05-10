<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Likes\Domain\Contracts\LikesRepository;
use Src\Api\Likes\Infrstructure\LikesEloquentRepository;

class LikeProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LikesRepository::class, LikesEloquentRepository::class);
    }
}
