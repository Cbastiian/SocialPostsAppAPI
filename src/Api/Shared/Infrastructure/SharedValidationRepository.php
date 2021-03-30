<?php

namespace Src\Api\Shared\Infrastructure;

use App\Models\PasswordReset;
use Carbon\Carbon;
use Src\Api\Shared\Domain\Contracts\SharedValidations;
use Src\Api\Shared\Domain\Exceptions\OtpValidationFailError;
use Src\Api\Shared\Domain\Exceptions\TokenExpireError;
use Src\Api\Shared\Domain\Exceptions\TokenNotValidError;
use Src\Api\Shared\Domain\ValueObjects\Token;

final class SharedValidationRepository implements SharedValidations
{
    public function throwIfOtpValidationFail(bool $status)
    {
        if (!$status)  throw new OtpValidationFailError();
    }

    public function throwIfTokenIsNotValid(Token $token)
    {
        $resetToken = $this->findToken($token);

        if ($resetToken === null)  throw new TokenNotValidError();
    }

    public function throwIfTokenExpire($date)
    {
        $expireDate = $this->checkTokenCreationTime($date);

        if ($expireDate > intval(env("RESET_PASSWORD_TOKEN_EXPIRE", 60))) throw new TokenExpireError();
    }

    public function findToken(Token $token)
    {
        return PasswordReset::where('token', $token->value())->first();
    }

    public function checkTokenCreationTime($creationDate)
    {
        $currentTime = Carbon::now();

        $diference = $currentTime->diffInMinutes($creationDate);

        return $diference;
    }
}
