<?php

declare(strict_types=1);

namespace Src\Api\History\Domain\Contracts;

use Src\Api\History\Domain\HistoryEntity;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\History\Domain\ValueObjects\HistoryId;

interface HistoryRepository
{
    public function saveHistory(HistoryEntity  $historyEntity);
    public function getHistories(UserId $userId);
    public function changeHistoryStatus(HistoryId $historyId, Status $status);
}
