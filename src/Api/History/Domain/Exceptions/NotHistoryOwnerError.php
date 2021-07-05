<?php

namespace Src\Api\History\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\History\Domain\ValueObjects\HistoryId;

final class NotHistoryOwnerError extends DomainError
{
    private HistoryId $historyId;
    private UserId $userId;

    public function __construct(
        HistoryId $historyId,
        UserId $userId
    ) {
        $this->historyId = $historyId;
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'NOT_HISTORY_OWNER';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId->value() . ' is not the owner of the history with id ' . $this->historyId->value();
    }
}
