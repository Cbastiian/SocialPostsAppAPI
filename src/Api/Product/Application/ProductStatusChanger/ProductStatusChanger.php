<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductStatusChanger;

use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductStatusChanger
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        ProductId $productId,
        Status $status
    ) {
        $this->productRepository->changeProductStatus($productId, $status);
    }
}
