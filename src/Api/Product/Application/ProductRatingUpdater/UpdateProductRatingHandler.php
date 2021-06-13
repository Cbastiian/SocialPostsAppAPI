<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductRatingUpdater;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Product\Domain\ValueObjects\Value;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class UpdateProductRatingHandler implements CommandHandler
{
    private ProductRatingUpdater $productRatingUpdater;
    private ProductValidation $productValidation;
    private UserValidation $userValidation;

    public function __construct(
        ProductRatingUpdater $productRatingUpdater,
        ProductValidation $productValidation,
        UserValidation $userValidation
    ) {
        $this->productRatingUpdater = $productRatingUpdater;
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
        $this->productValidation->throwIfProductNotRated($productId, $userId);

        $this->productRatingUpdater->__invoke(
            $value,
            $productId,
            $userId,
            $userComment
        );
    }
}
