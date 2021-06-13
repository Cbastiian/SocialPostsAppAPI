<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\FavoriteProductsGetter;

use Src\Api\Shared\Domain\ValueObjects\Page;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Limit;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class FavoriteProductsGetter
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        UserId $userId,
        Limit $limit,
        Page $page
    ) {
        return $this->productRepository->getFavoriteProducts(
            $userId,
            $limit,
            $page
        );
    }
}
