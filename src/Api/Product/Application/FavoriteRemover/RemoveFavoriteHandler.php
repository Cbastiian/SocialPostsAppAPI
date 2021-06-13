<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\FavoriteRemover;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class RemoveFavoriteHandler implements CommandHandler
{
    private FavoriteRemover $favoriteRemover;
    private ProductValidation $productValidation;
    private UserValidation $userValidation;

    public function __construct(
        FavoriteRemover $favoriteRemover,
        ProductValidation $productValidation,
        UserValidation $userValidation
    ) {
        $this->favoriteRemover = $favoriteRemover;
        $this->productValidation = $productValidation;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $userId = new UserId($command->getUserId());
        $productId = new ProductId($command->getProductId());

        $this->userValidation->throwIfUserNotExist($userId);
        $this->productValidation->throwIfProductIdNotExist($productId);
        $this->productValidation->throwIfProductNotInFavorites($productId, $userId);

        $this->favoriteRemover->__invoke(
            $productId,
            $userId
        );
    }
}
