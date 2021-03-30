<?php

declare(strict_types=1);

namespace Src\Api\User\Application\PasswordResetEmailSender;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\User\Domain\ValueObjects\Email;

final class SendPasswordResetEmailHandler implements CommandHandler
{
    private PasswordResetEmailSender $passwordResetEmailSender;
    private UserValidation $userValidation;

    public function __construct(
        PasswordResetEmailSender $passwordResetEmailSender,
        UserValidation $userValidation
    ) {
        $this->passwordResetEmailSender = $passwordResetEmailSender;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $email = new Email($command->getEmail());

        $this->userValidation->throwIfEmailNotExistError($email);

        $expireTime = intval(env("USER_VALIDATION_OTP_EXPIRE", 20));

        $this->passwordResetEmailSender->__invoke($email, $expireTime);
    }
}
