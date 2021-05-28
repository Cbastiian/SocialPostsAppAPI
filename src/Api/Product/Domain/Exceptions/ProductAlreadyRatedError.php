<?php

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Product\Domain\ValueObjects\ProductId;

final class ProductAlreadyRatedError extends DomainError
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
        return 'PRODUCT_ALREADY_RATED';
    }

    public function errorMessage(): string
    {
        return 'The product with id ' . $this->productId->value() . ' already rated by the user with id ' . $this->userId->value();
    }
}
