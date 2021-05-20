<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCreator;

use Src\Api\Product\Domain\ProductEntity;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductRepository;

final class ProductCreator
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        Title $title,
        Description $description,
        Price $price,
        UserComment $userComment,
        ProductCode $productCode,
        Image $image,
        UserId $userId
    ) {
        $product = ProductEntity::create(
            $title,
            $description,
            $price,
            $userComment,
            $productCode,
            $image,
            $userId
        );

        return $this->productRepository->saveProduct($product);
    }
}
