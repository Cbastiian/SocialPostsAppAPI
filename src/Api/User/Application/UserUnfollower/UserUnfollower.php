<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserUnfollower;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;

final class UserUnfollower
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserId $followingUserId)
    {
        return $this->userRepository->unfollowUser($followingUserId);
    }
}
