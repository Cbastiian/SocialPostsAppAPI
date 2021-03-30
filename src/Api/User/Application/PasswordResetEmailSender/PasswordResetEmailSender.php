<?php

declare(strict_types=1);

namespace Src\Api\User\Application\PasswordResetEmailSender;

use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\ValueObjects\Email;

final class PasswordResetEmailSender
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Email $email, int $expireTime)
    {
        $this->userRepository->generatePasswordReset($email, $expireTime);
    }
}
