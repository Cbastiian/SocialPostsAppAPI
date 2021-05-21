<?php

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Product\Domain\ValueObjects\ProductCode;

final class ProductCodeNotFoundError extends DomainError
{
    private ProductCode $productCode;

    public function __construct(ProductCode $productCode)
    {
        $this->productCode = $productCode;
    }

    public function errorCode(): string
    {
        return 'PRODUCT_CODE_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The product code ' . $this->productCode->value() . ' not exist';
    }
}
