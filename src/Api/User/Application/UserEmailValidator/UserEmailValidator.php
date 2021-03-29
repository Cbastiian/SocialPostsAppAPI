<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserEmailValidator;

use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\ValueObjects\Email;

final class UserEmailValidator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Email $email, bool $status)
    {
        $this->userRepository->changeActiveStatus($email, $status);
    }
}
