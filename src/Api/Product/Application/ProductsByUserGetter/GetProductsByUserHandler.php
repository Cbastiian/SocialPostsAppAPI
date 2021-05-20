<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductsByUserGetter;

use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetProductsByUserHandler implements CommandHandler
{
    private ProductsByUserGetter $productsByUserGetter;
    private UserValidation $userValidation;

    public function __construct(
        ProductsByUserGetter $productsByUserGetter,
        UserValidation $userValidation
    ) {
        $this->productsByUserGetter = $productsByUserGetter;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $username = new Username($command->getUsername());

        $this->userValidation->throwIfUsernameNotExist($username);

        return $this->productsByUserGetter->__invoke($username);
    }
}
