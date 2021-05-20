<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductsByUserGetter;

use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductsByUserGetter
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Username $username)
    {
        return $this->productRepository->getProductsByUser($username);
    }
}
