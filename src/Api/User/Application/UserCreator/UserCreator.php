<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserCreator;

use Src\Api\User\Domain\UserBuilder;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserRepository;

final class UserCreator
{
    private UserRepository $userRepository;

    public  function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(
        Name $name,
        Email $email,
        Username $username,
        Password $password,
        Photo $photo
    ) {
        $userBuilder = new  UserBuilder();

        $user = $userBuilder
            ->withName($name)
            ->withEmail($email)
            ->withUsername($username)
            ->withPassword($password)
            ->withPhoto($photo)
            ->buildCreateUser();

        return $this->userRepository->createUser($user);
    }
}
