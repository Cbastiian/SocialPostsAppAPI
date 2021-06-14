<?php

declare(strict_types=1);

namespace Src\Api\History\Domain\Contracts;

use Src\Api\History\Domain\HistoryEntity;

interface HistoryRepository
{
    public function saveHistory(HistoryEntity  $historyEntity);
}
