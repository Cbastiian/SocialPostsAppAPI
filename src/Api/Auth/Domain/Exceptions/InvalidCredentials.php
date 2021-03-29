<?php

namespace Src\Api\Auth\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;

final class InvalidCredentials extends DomainError
{
    public function errorCode(): string
    {
        return 'INVALID_CREDENTIALS';
    }

    public function errorMessage(): string
    {
        return 'Invalid credentials';
    }
}
