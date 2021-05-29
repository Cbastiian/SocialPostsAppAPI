<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\FavoritesCreator;

use Src\Api\Shared\Domain\Contracts\Command;

final class CreateFavoriteCommand implements Command
{
    private int $productId;
    private int $userId;

    public function __construct(
        int $productId,
        int $userId
    ) {
        $this->productId = $productId;
        $this->userId = $userId;
    }

    /***
     * get the value of productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
