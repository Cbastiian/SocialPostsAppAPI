<?php

namespace Src\Api\Shared\Infrastructure;

use App\Models\PasswordReset;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Ichtrojan\Otp\Otp;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\Shared\Domain\ValueObjects\Token;

final class SharedEloquentRepository implements SharedRepository
{
    public function getOtpCode(string $identifier, int $expireTime)
    {
        $otp = new Otp();
        return $otp->generate($identifier, 6, $expireTime);
    }

    public function otpCodeValidator(string $identifier, OtpCode $otpCode)
    {
        $otp = new Otp();
        return $otp->validate($identifier, $otpCode->value());
    }

    public function findToken(Token $token)
    {
        return PasswordReset::where('token', $token->value())->first();
    }

    public function deletePasswordReset(Token $token)
    {
        PasswordReset::where('token', $token->value())->delete();
    }
}
