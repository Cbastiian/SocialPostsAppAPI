<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductByCodeGetter;

use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductByCodeGetter
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(ProductCode $productCode)
    {
        return $this->productRepository->getProductByCode($productCode);
    }
}
