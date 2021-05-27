<?php

declare(strict_types=1);

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Product\Domain\ValueObjects\ProductId;

final class ProductNotRatedError extends DomainError
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
        return 'PRODUCT_NOT_RATED';
    }

    public function errorMessage(): string
    {
        return 'The product with id ' . $this->productId->value() . ' is not rated by the user with id ' . $this->userId->value();
    }
}
