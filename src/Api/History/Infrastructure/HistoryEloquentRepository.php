<?php

namespace Src\Api\History\Infrastructure;

use App\Models\History;
use Src\Api\History\Domain\HistoryEntity;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class HistoryEloquentRepository implements HistoryRepository
{
    public function saveHistory(HistoryEntity $historyEntity)
    {
        return History::create($historyEntity->toArray());
    }
}
