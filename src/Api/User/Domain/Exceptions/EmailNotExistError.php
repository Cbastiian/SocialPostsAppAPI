<?php

declare(strict_types=1);

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\Email;

final class EmailNotExistError extends DomainError
{
    private  Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function errorCode(): string
    {
        return 'EMAIL_NOT_EXIST';
    }

    public  function errorMessage(): string
    {
        return 'User whith email ' . $this->email->value() . ' not exist';
    }
}
