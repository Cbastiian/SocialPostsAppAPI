<?php

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\Shared\Domain\Exceptions\DomainError;

final class UsernameNotExistError extends DomainError
{
    private Username $username;

    public function __construct(Username $username)
    {
        $this->username = $username;
    }

    public function errorCode(): string
    {
        return 'USERNAME_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The user with username ' . $this->username->value() . ' not exist';
    }
}
