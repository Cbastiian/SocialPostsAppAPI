<?php

namespace Src\Api\Shared\Domain\Contracts;

use Src\Api\Shared\Domain\ValueObjects\Token;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;

interface SharedRepository
{
    public function getOtpCode(string $identifier, int $expireTime);
    public function otpCodeValidator(string $identifier, OtpCode $otpCode);
    public function findToken(Token $token);
    public function deletePasswordReset(Token $token);
    public function resourceCodeGenerator();
}
