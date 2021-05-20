<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\GeneralProductsGetter;

use Src\Api\Product\Domain\Contracts\ProductRepository;

final class GeneralProductsGetter
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke()
    {
        return $this->productRepository->getGeneralProducts();
    }
}
