<?php

namespace Src\Api\Product\Infrastructure;

use App\Models\Product;
use Src\Api\Product\Domain\ProductEntity;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductEloquentRepository implements ProductRepository
{
    public function saveProduct(ProductEntity $productEntity)
    {
        return Product::create($productEntity->toArray());
    }
}
