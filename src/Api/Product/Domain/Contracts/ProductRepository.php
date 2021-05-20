<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\Product\Domain\ProductEntity;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Product\Domain\ValueObjects\ProductId;

interface ProductRepository
{
    public function saveProduct(ProductEntity $productEntity);
    public function updateProduct(ProductId $productId, ProductEntity $productEntity);
    public function changeProductStatus(ProductId $productId, Status $status);
}
