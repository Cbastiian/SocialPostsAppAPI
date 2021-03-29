<?php

namespace Src\Api\User\Domain\Contracts;

use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\UserEntity;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;

interface UserRepository
{
    public function createUser(UserEntity $userEntity);
    public function sendRegisterEmailVerification(Name $name, Email $email, OtpCode $otpCode, int $expireTime);
}
