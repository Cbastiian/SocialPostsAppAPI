<?php

declare(strict_types=1);

namespace Src\Api\User\Application\PasswordReseter;

use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Password;

final class PasswordReseter
{
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Email $email, Password $password)
    {
        $this->userRepository->changePassword($email, $password);
    }
}
