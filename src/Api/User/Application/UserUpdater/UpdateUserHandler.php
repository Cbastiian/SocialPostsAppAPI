<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserUpdater;

use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class UpdateUserHandler implements CommandHandler
{
    private UserUpdater $userUpdater;
    private UserValidation $userValidation;

    public function __construct(
        UserUpdater $userUpdater,
        UserValidation $userValidation
    ) {
        $this->userUpdater =   $userUpdater;
        $this->userValidation =   $userValidation;
    }

    public function execute($commnand)
    {
        $userId = new UserId($commnand->getUserId());
        $name = new Name($commnand->getName());
        $email = new Email($commnand->getEmail());
        $username = new Username($commnand->getUsername());

        $this->userValidation->throwIfUserNotExist($userId);
        $this->userValidation->throwIfNotSelfEmail($userId, $email);

        $this->userUpdater->__invoke($userId, $name, $email, $username);
    }
}
