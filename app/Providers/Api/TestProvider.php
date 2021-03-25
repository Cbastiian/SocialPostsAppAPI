<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Test\Domain\Contracts\TestRepository;
use Src\Api\Test\Infrastructure\TestEloquentRepository;

class TestProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TestRepository::class, TestEloquentRepository::class);
    }
}
