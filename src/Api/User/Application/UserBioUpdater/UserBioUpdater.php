<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserBioUpdater;

use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\ValueObjects\Bio;
use Src\Api\User\Domain\ValueObjects\UserId;

final class UserBioUpdater
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserId $userId, Bio $bio)
    {
        $this->userRepository->updateBio($userId, $bio);
    }
}
