<?php

namespace Src\Api\Product\Application\FavoritesCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Product\Domain\ValueObjects\ProductId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\Contracts\ProductValidation;

final class CreateFavoriteHandler implements CommandHandler
{
    private FavoritesCreator $favoritesCreator;
    private ProductValidation $productValidation;
    private UserValidation $userValidation;

    public function __construct(
        FavoritesCreator $favoritesCreator,
        ProductValidation $productValidation,
        UserValidation $userValidation
    ) {
        $this->favoritesCreator = $favoritesCreator;
        $this->productValidation = $productValidation;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $productId = new ProductId($command->getProductId());
        $userId = new UserId($command->getUserId());

        $this->productValidation->throwIfProductIdNotExist($productId);
        $this->userValidation->throwIfUserNotExist($userId);
        $this->productValidation->throwIfProductAlreadyInFavorites($productId, $userId);
        $this->productValidation->throwIfProductOwner($productId, $userId);

        return $this->favoritesCreator->__invoke(
            $productId,
            $userId
        );
    }
}
