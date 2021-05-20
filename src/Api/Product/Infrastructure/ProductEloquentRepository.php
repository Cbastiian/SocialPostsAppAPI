<?php

namespace Src\Api\Product\Infrastructure;

use App\Models\Product;
use Src\Api\Product\Domain\ProductEntity;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductEloquentRepository implements ProductRepository
{
    public function saveProduct(ProductEntity $productEntity)
    {
        return Product::create($productEntity->toCreateArray());
    }

    public function updateProduct(ProductId $productId, ProductEntity $productEntity)
    {
        Product::where('id', $productId->value())
            ->first()
            ->update($productEntity->toUpdateArray());
    }

    public function changeProductStatus(ProductId $productId, Status $status)
    {
        Product::where('id', $productId->value())
            ->first()
            ->update(
                ['active' => intval($status->value())]
            );
    }
}
