<?php

namespace Src\Api\History\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\History\Domain\ValueObjects\HistoryId;

final class HistoryNotExistError extends DomainError
{
    private HistoryId $historyId;

    public function __construct(HistoryId $historyId)
    {
        $this->historyId = $historyId;
    }

    public function errorCode(): string
    {
        return 'HISTORY_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The history with id ' . $this->historyId->value() . ' not exist';
    }
}
