<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\History\Domain\Contracts\HistoryRepository;
use Src\Api\History\Domain\Contracts\HistoryValidation;
use Src\Api\History\Infrastructure\HistoryEloquentRepository;
use Src\Api\History\Infrastructure\HistoryValidationRepository;

class HistoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HistoryRepository::class, HistoryEloquentRepository::class);
        $this->app->bind(HistoryValidation::class, HistoryValidationRepository::class);
    }
}
