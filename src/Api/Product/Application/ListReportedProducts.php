<?php

declare(strict_types=1);

namespace Src\Api\Product\Application;

use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ListReportedProducts
{
    public ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke()
    {
        return $this->productRepository->getReportedProducts();
    }
}
