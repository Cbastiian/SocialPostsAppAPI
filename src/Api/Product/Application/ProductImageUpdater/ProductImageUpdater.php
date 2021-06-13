<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductImageUpdater;

use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductImageUpdater
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        ProductId $productId,
        Image $image
    ) {
        $this->productRepository->changeProductImage($productId, $image);
    }
}
