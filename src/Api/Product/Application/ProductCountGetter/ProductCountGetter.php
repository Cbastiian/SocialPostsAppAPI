<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCountGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductCountGetter
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(UserId $userId)
    {
        return $this->productRepository->getCount($userId);
    }
}
