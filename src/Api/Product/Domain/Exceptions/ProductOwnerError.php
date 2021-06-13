<?php

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Product\Domain\ValueObjects\ProductId;

final class ProductOwnerError extends DomainError
{
    private ProductId $productId;
    private UserId $userId;

    public function __construct(
        ProductId $productId,
        UserId $userId
    ) {
        $this->productId = $productId;
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'PRODUCT_OWNER';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId->value() . ' is the owner of the product with id ' . $this->productId->value();
    }
}
