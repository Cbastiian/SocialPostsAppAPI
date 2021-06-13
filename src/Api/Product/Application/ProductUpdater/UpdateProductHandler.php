<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductUpdater;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class UpdateProductHandler implements CommandHandler
{
    private ProductUpdater $productUpdater;
    private ImageCreator $imageCreator;
    private ProductValidation $productValidation;

    public function __construct(
        ProductUpdater $productUpdater,
        ImageCreator $imageCreator,
        ProductValidation $productValidation
    ) {
        $this->productUpdater = $productUpdater;
        $this->imageCreator = $imageCreator;
        $this->productValidation = $productValidation;
    }

    public function execute($command)
    {
        $productId = new ProductId($command->getProductId());
        $title = new Title($command->getTitle());
        $description = new Description($command->getDescription());
        $userComment = new UserComment($command->getUserComment());
        $price = new Price($command->getPrice());
        $userId = new UserId($command->getUserId());

        $this->productValidation->throwIfProductIdNotExist($productId);
        $this->productValidation->throwIfProductUpdateTitleAlreadyExist($title, $productId);
        $this->productValidation->throwIfNotProductOwner($productId, $userId);

        $this->productUpdater->__invoke(
            $productId,
            $title,
            $description,
            $userComment,
            $price
        );
    }
}
