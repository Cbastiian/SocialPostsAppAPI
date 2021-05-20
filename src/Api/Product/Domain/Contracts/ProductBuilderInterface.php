<?php

namespace Src\Api\Product\Domain\Contracts;

use Src\Api\Product\Domain\ProductEntity;

interface ProductBuilderInterface
{
    public function buildCreateProduct(): ProductEntity;
    public function buildBasicUpdateProduct(): ProductEntity;
}
