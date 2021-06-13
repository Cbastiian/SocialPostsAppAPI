<?php

namespace App\Providers\Api;

use Illuminate\Support\ServiceProvider;
use Src\Api\Product\Domain\Contracts\ProductRepository;
use Src\Api\Product\Domain\Contracts\ProductValidation;
use Src\Api\Product\Infrastructure\ProductEloquentRepository;
use Src\Api\Product\Infrastructure\ProductValidationRepository;

class ProductProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepository::class, ProductEloquentRepository::class);
        $this->app->bind(ProductValidation::class, ProductValidationRepository::class);
    }
}
