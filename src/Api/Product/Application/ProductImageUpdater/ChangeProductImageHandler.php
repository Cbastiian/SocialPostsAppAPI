<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductImageUpdater;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Application\Images\ImageDestroyer;
use Src\Api\Product\Domain\Constants\ProductConstants;
use Src\Api\Product\Domain\Contracts\ProductRepository;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class ChangeProductImageHandler implements CommandHandler
{
    private ProductImageUpdater $productImageUpdater;
    private ProductValidation $productValidation;
    private ImageCreator $imageCreator;
    private ImageDestroyer $imageDestroyer;
    private ProductRepository $productRepository;

    public function __construct(
        ProductImageUpdater $productImageUpdater,
        ProductValidation $productValidation,
        ImageCreator $imageCreator,
        ImageDestroyer $imageDestroyer,
        ProductRepository $productRepository
    ) {
        $this->productImageUpdater = $productImageUpdater;
        $this->productValidation = $productValidation;
        $this->imageCreator = $imageCreator;
        $this->imageDestroyer = $imageDestroyer;
        $this->productRepository = $productRepository;
    }

    public function execute($command)
    {
        $productId = new ProductId($command->getProductId());
        $userId = new UserId($command->getUserId());

        $productData = $this->productRepository->findProductById($productId);

        $productImage = $command->getImage() ?
            $this->imageCreator->__invoke($command->getImage(), 'img/products/') :
            (object)['imageName' => ProductConstants::PRODUCT_IMAGE_PATH];

        $image = new Image($productImage->imageName);

        if ($productData->image != ProductConstants::PRODUCT_IMAGE_PATH) $this->imageDestroyer->__invoke($productData->image);

        $this->productValidation->throwIfProductIdNotExist($productId);
        $this->productValidation->throwIfNotProductOwner($productId, $userId);

        $this->productImageUpdater->__invoke($productId, $image);
    }
}
