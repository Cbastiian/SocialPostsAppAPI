<?php

namespace Src\Api\Shared\Domain\Exceptions;

final class OtpValidationFailError extends DomainError
{
    public function errorCode(): string
    {
        return 'OTP_CODE_INVALID';
    }

    public function errorMessage(): string
    {
        return 'The OTP validation fail';
    }
}
