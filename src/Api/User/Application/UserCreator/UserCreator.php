<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserCreator;

use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\UserEntity;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\Username;

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

        $userEntity = UserEntity::create($name, $email, $username, $password, $photo);

        return $this->userRepository->createUser($userEntity);
    }
}
