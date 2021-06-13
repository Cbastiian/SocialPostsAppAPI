<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductRatingCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Value;
use Src\Api\Product\Domain\ProductRatingBuilder;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductRatingCreator
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
            ->withProductId($productId)
            ->withUserId($userId)
            ->withUserComment($userComment)
            ->buildCreateProductRating();

        return $this->productRepository->saveRating($rating);
    }
}
