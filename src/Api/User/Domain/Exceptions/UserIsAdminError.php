<?php
namespace Src\Api\User\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Domain\ValueObjects\UserId;

final class UserIsAdminError extends DomainError{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'USER_IS_ADMIN';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId . ' is admin';
    }
}