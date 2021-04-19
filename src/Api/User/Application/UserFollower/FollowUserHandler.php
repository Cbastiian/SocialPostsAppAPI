<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserFollower;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class FollowUserHandler implements CommandHandler
{
    private UserFollower $userFollower;
    private UserValidation $userValidation;

    public function __construct(UserFollower $userFollower, UserValidation $userValidation)
    {
        $this->userFollower = $userFollower;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $followingUserId = new UserId($command->getFollowingUserId());
        $this->userValidation->throwIfUserNotExist($followingUserId);

        return  $this->userFollower->__invoke($followingUserId);
    }
}
