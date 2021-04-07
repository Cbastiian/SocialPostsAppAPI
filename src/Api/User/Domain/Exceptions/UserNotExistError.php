<?php

declare(strict_types=1);

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\UserId;

final class UserNotExistError extends DomainError
{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'USER_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The user whit id ' . $this->userId . ' not exist';
    }
}
