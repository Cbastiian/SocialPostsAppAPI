<?php

namespace Src\Api\Shared\Domain\Exceptions;

final class TokenNotValidError extends DomainError
{
    public function errorCode(): string
    {
        return 'TOKEN_NOT_VALID';
    }

    public function errorMessage(): string
    {
        return 'The token is not valid';
    }
}
