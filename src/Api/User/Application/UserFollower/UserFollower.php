<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserFollower;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;

final class UserFollower
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserId $followingUserId)
    {
        return $this->userRepository->followUser($followingUserId);
    }
}
