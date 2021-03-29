<?php

declare(strict_types=1);

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\Username;

final class UsernameAlreadyExists extends DomainError
{
    private Username $username;

    public function __construct(Username $username)
    {
        $this->username = $username;
    }

    public function errorCode(): string
    {
        return 'USERNAME_AREADY_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The username ' . $this->username->value() . ' already exist';
    }
}
