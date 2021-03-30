<?php

declare(strict_types=1);

namespace Src\Api\User\Application\ResendVerificationEmail;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Application\UserCreator\EmailVerificationSend;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;

final class ResendVerificationEmailHandler implements CommandHandler
{
    private UserRepository $userRepository;
    private SharedRepository $sharedRepository;
    private EmailVerificationSend $emailVerificationSend;
    private UserValidation $userValidation;

    public function __construct(
        UserRepository $userRepository,
        SharedRepository $sharedRepository,
        EmailVerificationSend $emailVerificationSend,
        UserValidation $userValidation
    ) {
        $this->userRepository = $userRepository;
        $this->sharedRepository = $sharedRepository;
        $this->emailVerificationSend = $emailVerificationSend;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $email = new Email($command->getEmail());

        $this->userValidation->throwIfUserAlreadyActive($email);

        $userData = $this->userRepository->findByEmail($email);

        $name = new Name($userData->name);

        $expireTime = intval(env("USER_VALIDATION_OTP_EXPIRE", 20));

        $otpCode = new OtpCode($this->sharedRepository->getOtpCode(
            $email->value(),
            $expireTime
        )->token);

        $this->emailVerificationSend->__invoke($name, $email, $otpCode, $expireTime);
    }
}
