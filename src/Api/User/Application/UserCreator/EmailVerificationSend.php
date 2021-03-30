<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserCreator;

use App\Mail\Api\User\RegisterVerificationMailiable;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;

final class EmailVerificationSend
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function __invoke(Name $name, Email $email, OtpCode $otpCode, int $expireTime)
    {
        $this->userRepository->sendRegisterEmailVerification($name, $email, $otpCode, $expireTime);
    }
}
