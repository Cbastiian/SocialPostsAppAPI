<?php

namespace Src\Api\Product\Application\ProductByTitleFinder;

use Src\Api\Shared\Domain\ValueObjects\Page;
use Src\Api\Shared\Domain\ValueObjects\Limit;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductByTitleFinder
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Title $title, Limit $limit, Page $page)
    {
        return $this->productRepository->findProductByCoincidence($title, $limit, $page);
    }
}
