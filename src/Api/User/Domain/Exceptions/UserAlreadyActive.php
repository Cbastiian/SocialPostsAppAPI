<?php

declare(strict_types=1);

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\Email;

final class UserAlreadyActive extends DomainError
{
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function errorCode(): string
    {
        return 'USER_ALREADY_ACTIVE';
    }

    public function errorMessage(): string
    {
        return 'The user whith email ' . $this->email->value() . ' is already active';
    }
}
