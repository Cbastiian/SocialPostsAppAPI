<?php

namespace Src\Api\Product\Application\FavoritesCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class FavoritesCreator
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        ProductId $productId,
        UserId $userId
    ) {
        return $this->productRepository->createFavorite($productId, $userId);
    }
}
