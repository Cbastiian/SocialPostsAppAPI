<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserUnfollower;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class UnfollowUserHandler implements CommandHandler
{
    private UserUnfollower $userUnfollower;
    private UserValidation $userValidation;

    public function __construct(UserUnfollower $userUnfollower, UserValidation $userValidation)
    {
        $this->userUnfollower = $userUnfollower;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $followingUserId = new UserId($command->getFollowingUserId());
        $this->userValidation->throwIfUserNotExist($followingUserId);

        return  $this->userUnfollower->__invoke($followingUserId);
    }
}
