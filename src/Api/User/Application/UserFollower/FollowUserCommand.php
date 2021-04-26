<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserFollower;

use Src\Api\Shared\Domain\Contracts\Command;

final class FollowUserCommand implements Command
{
    private int $followingUserId;

    public function __construct(int $followingUserId)
    {
        $this->followingUserId = $followingUserId;
    }

    /***
     * get the value of flollowingUserId
     */
    public function getFollowingUserId()
    {
        return $this->followingUserId;
    }
}
