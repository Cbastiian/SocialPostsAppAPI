<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Constants\ProductConstants;
use Src\Api\Product\Domain\Contracts\ProductValidation;
use Src\Api\Shared\Application\Codes\CodeResourceGenerator;

final class CreateProductHandler implements CommandHandler
{
    private ProductCreator $productCreator;
    private CodeResourceGenerator $codeReosurceGenerator;
    private ImageCreator $imageCreator;
    private ProductValidation $productValidation;

    public function __construct(
        ProductCreator $productCreator,
        CodeResourceGenerator $codeReosurceGenerator,
        ImageCreator $imageCreator,
        ProductValidation $productValidation
    ) {
        $this->productCreator = $productCreator;
        $this->codeReosurceGenerator = $codeReosurceGenerator;
        $this->imageCreator = $imageCreator;
        $this->productValidation = $productValidation;
    }

    public function execute($command)
    {
        $title = new Title($command->getTitle());
        $description = new Description($command->getDescription());
        $price = new Price($command->getPrice());
        $userComment = new UserComment($command->getUserComment());
        $productCode = new ProductCode($this->codeReosurceGenerator->__invoke());
        $userId = new UserId($command->getUserId());

        $this->productValidation->throwIfProductNameAlreadyExist($userId, $title);

        $productImage = $command->getImage() ?
            $this->imageCreator->__invoke($command->getImage(), 'img/products/') :
            (object)['imageName' => ProductConstants::PRODUCT_IMAGE_PATH];

        $image = new Image($productImage->imageName);

        return $this->productCreator->__invoke(
            $title,
            $description,
            $price,
            $userComment,
            $productCode,
            $image,
            $userId
        );
    }
}
