<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductUpdater;

use Src\Api\Product\Domain\ProductBuilder;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductUpdater
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        ProductId $productId,
        Title $title,
        Description $description,
        UserComment $userComment,
        Price $price
    ) {
        $productBuilder = new ProductBuilder();

        $product = $productBuilder
            ->withTitle($title)
            ->withDescription($description)
            ->withPrice($price)
            ->withUserComment($userComment)
            ->buildBasicUpdateProduct();

        $this->productRepository->updateProduct($productId, $product);
    }
}
