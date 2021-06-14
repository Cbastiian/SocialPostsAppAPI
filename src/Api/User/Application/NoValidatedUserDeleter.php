<?php

declare(strict_types=1);

namespace Src\Api\User\Application;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Application\UserDeleter\UserDeleter;

final class NoValidatedUserDeleter
{
    private UserRepository $userRepository;
    private ExpiredUserCheck $expiredUserCheck;
    private UserDeleter $userDeleter;

    public function __construct(
        UserRepository $userRepository,
        ExpiredUserCheck $expiredUserCheck,
        UserDeleter $userDeleter
    ) {
        $this->userRepository = $userRepository;
        $this->expiredUserCheck = $expiredUserCheck;
        $this->userDeleter = $userDeleter;
    }

    public  function __invoke()
    {
        $noActiveUsers = $this->userRepository->getNoActiveUsers();

        foreach ($noActiveUsers as $user) {
            if ($this->expiredUserCheck->__invoke(strval($user['created_at']))) {
                $userId = new UserId($user['id']);

                $this->userDeleter->__invoke($userId);
            }
        }
    }
}
