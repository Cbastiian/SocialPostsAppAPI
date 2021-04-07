<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserBioUpdater;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\User\Domain\ValueObjects\Bio;
use Src\Api\User\Domain\ValueObjects\UserId;

final class UpdateUserBioHandler implements CommandHandler
{
    private UserBioUpdater $userBioUpdater;
    private UserValidation $userValidation;

    public function __construct(UserBioUpdater $userBioUpdater, UserValidation $userValidation)
    {
        $this->userBioUpdater = $userBioUpdater;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $userId = new UserId($command->getUserId());
        $bio = new Bio($command->getBio());

        $this->userValidation->throwIfUserNotExist($userId);

        $this->userBioUpdater->__invoke($userId, $bio);
    }
}
