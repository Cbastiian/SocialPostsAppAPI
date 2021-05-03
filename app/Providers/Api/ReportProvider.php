<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Infrastructure\ReportEloquentRepository;
use Src\Api\Reports\Infrastructure\ReportValidationRepository;

class ReportProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ReportsRepository::class, ReportEloquentRepository::class);
        $this->app->bind(ReportValidation::class, ReportValidationRepository::class);
    }
}
