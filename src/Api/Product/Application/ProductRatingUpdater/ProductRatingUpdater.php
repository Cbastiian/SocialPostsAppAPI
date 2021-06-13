<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductRatingUpdater;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Value;
use Src\Api\Product\Domain\ProductRatingBuilder;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductRatingUpdater
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        Value $value,
        ProductId $productId,
        UserId $userId,
        UserComment $userComment
    ) {
        $productRatingBuilder = new ProductRatingBuilder();

        $rating = $productRatingBuilder
            ->withValue($value)
            ->withUserComment($userComment)
            ->buildUpdateProductRating();

        $this->productRepository->updateRating($productId, $userId, $rating);
    }
}