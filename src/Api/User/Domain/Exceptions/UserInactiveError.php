<?php

declare(strict_types=1);

namespace Src\Api\User\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;

final class UserInactiveError extends DomainError
{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'USER_INACTIVE';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId . ' is not active';
    }
}
