<?php

namespace Src\Api\Shared\Domain\Contracts;

use Src\Api\Shared\Domain\ValueObjects\Token;

interface SharedValidations
{
    public function throwIfOtpValidationFail(bool $status);
    public function throwIfTokenIsNotValid(Token $token);
    public function throwIfTokenExpire($date);
}
