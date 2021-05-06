<?php

declare(strict_types=1);

namespace Src\Api\User\Application;

use Src\Api\User\Domain\Contracts\UserRepository;

final class ListReportedUsers
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        return $this->userRepository->getReportedUsers();
    }
}
