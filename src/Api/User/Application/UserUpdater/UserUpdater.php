<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserUpdater;

use Src\Api\User\Domain\UserBuilder;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserRepository;

final class UserUpdater
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(
        UserId $userId,
        Name $name,
        Email $email,
        Username $username
    ) {
        $userBuilder = new UserBuilder();

        $user = $userBuilder
            ->withName($name)
            ->withEmail($email)
            ->withUsername($username)
            ->buildUpdateUser();

        return $this->userRepository->updateUser($userId, $user);
    }
}
