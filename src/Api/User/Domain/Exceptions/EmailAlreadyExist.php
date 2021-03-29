<?php

declare(strict_types=1);

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\Email;

final class EmailAlreadyExist extends DomainError
{
    private Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function errorCode(): string
    {
        return 'EMAIL_ALREADY_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The email ' . $this->email->value() . ' already exist';
    }
}
