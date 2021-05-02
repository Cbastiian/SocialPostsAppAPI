<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Infrastructure\ReportEloquentRepository;

class ReportProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ReportsRepository::class, ReportEloquentRepository::class);
    }
}
