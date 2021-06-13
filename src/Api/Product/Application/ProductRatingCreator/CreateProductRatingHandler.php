<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductRatingCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Value;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class CreateProductRatingHandler implements CommandHandler
{
    private ProductRatingCreator $productRatingCreator;
    private ProductValidation $productValidation;
    private UserValidation $userValidation;

    public function __construct(
        ProductRatingCreator $productRatingCreator,
        ProductValidation $productValidation,
        UserValidation $userValidation
    ) {
        $this->productRatingCreator = $productRatingCreator;
        $this->productValidation = $productValidation;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $value = new Value($command->getValue());
        $productId = new ProductId($command->getProductId());
        $userId = new UserId($command->getUserId());
        $userComment = new UserComment($command->getUserComment());

        $this->productValidation->throwIfProductIdNotExist($productId);
        $this->userValidation->throwIfUserNotExist($userId);
        $this->productValidation->throwIfProductAlreadyRated($productId, $userId);
        $this->productValidation->throwIfProductOwner($productId, $userId);

        return $this->productRatingCreator->__invoke(
            $value,
            $productId,
            $userId,
            $userComment
        );
    }
}
