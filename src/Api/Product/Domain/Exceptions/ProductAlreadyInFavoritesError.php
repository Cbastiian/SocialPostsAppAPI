<?php

namespace Src\Api\Product\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Product\Domain\ValueObjects\ProductId;

final class ProductAlreadyInFavoritesError extends DomainError
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
        return 'PRODUCT_ALREADY_IN_FAVORITES';
    }

    public function errorMessage(): string
    {
        return 'The product with id ' . $this->productId->value() . ' already in the favorites of the user with id ' . $this->userId->value();
    }
}
