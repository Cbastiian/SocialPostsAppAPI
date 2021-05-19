<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCreator;

use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductCreator
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke()
    {
    }
}
