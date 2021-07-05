<?php

declare(strict_types=1);

namespace Src\Api\History\Domain\Contracts;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\History\Domain\ValueObjects\HistoryId;

interface HistoryValidation
{
    public function throwIfHistoryNotExist(HistoryId $historyId);
    public function throwIfNotHistoryOwner(HistoryId $historyId, UserId $userId);
}
