<?php

declare(strict_types=1);

namespace Src\Api\User\Application;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;

final class UserRoleAssigner
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserId $userId)
    {
        $this->userRepository->assignRoles($userId);
    }
}
