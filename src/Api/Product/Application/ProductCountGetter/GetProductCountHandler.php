<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCountGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetProductCountHandler implements CommandHandler
{
    private ProductCountGetter $productCountGetter;
    private UserValidation $userValidation;

    public function __construct(
        ProductCountGetter $productCountGetter,
        UserValidation $userValidation
    ) {
        $this->productCountGetter = $productCountGetter;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $userId = new UserId($command->getUserId());

        $this->userValidation->throwIfUserNotExist($userId);

        return $this->productCountGetter->__invoke($userId);
    }
}
