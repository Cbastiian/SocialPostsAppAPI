<?php

namespace Src\Api\Shared\Domain\Exceptions;

final class TokenExpireError extends DomainError
{
    public function errorCode(): string
    {
        return 'TOKEN_EXPIRE';
    }

    public function errorMessage(): string
    {
        return 'The token is expired';
    }
}
