<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\FavoriteRemover;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class FavoriteRemover
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
        $this->productRepository->removeFavorite(
            $productId,
            $userId
        );
    }
}
