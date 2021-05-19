<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\Product\Domain\ProductEntity;

interface ProductRepository
{
    public function saveProduct(ProductEntity $productEntity);
}
