<?php

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Product\Domain\ValueObjects\ProductId;

final class ProductNotExistError extends DomainError
{
    private ProductId $productId;

    public function __construct(ProductId $productId)
    {
        $this->productId = $productId;
    }

    public function errorCode(): string
    {
        return 'PRODUCT_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The product with id ' . $this->productId->value() . ' not exist';
    }
}
