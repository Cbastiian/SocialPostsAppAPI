<?php

namespace Src\Api\User\Domain\Contracts;

use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\Shared\Domain\ValueObjects\Token;
use Src\Api\User\Domain\UserEntity;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Password;

interface UserRepository
{
    public function createUser(UserEntity $userEntity);
    public function generatePasswordReset(Email $email, int $expireTime);
    public function changeActiveStatus(Email $email, bool $status);
    public function changePassword(Email $email, Password $password);
    public function sendRegisterEmailVerification(Name $name, Email $email, OtpCode $otpCode, int $expireTime);
    public function findByEmail(Email $email);
}
