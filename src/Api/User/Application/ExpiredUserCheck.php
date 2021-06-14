<?php

declare(strict_types=1);

namespace Src\Api\User\Application;

use Src\Api\User\Domain\Constants\UserConstants;
use Src\Api\User\Domain\Contracts\UserRepository;

final class ExpiredUserCheck
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $creationDate)
    {
        $expire = $this->userRepository->checkUserCreationTime($creationDate);

        return $expire > UserConstants::USER_EXPIRE_MINUTE_DIFERENCE;
    }
}
