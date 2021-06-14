<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\History\Domain\Contracts\HistoryRepository;
use Src\Api\History\Infrastructure\HistoryEloquentRepository;

class HistoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HistoryRepository::class, HistoryEloquentRepository::class);
    }
}
