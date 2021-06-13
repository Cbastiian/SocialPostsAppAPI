<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\FavoriteProductsGetter;

use Src\Api\Shared\Domain\ValueObjects\Page;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Limit;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetFavoriteProductsHandler implements CommandHandler
{
    private FavoriteProductsGetter $favoriteProductsGetter;
    private UserValidation $userValidation;

    public function __construct(
        FavoriteProductsGetter $favoriteProductsGetter,
        UserValidation $userValidation
    ) {
        $this->favoriteProductsGetter = $favoriteProductsGetter;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $userId = new UserId($command->getUserId());
        $limit = new Limit($command->getLimit());
        $page = new Page($command->getPage());

        $this->userValidation->throwIfUserNotExist($userId);

        return $this->favoriteProductsGetter->__invoke($userId, $limit, $page);
    }
}
