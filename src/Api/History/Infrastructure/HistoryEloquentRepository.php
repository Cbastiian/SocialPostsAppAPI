<?php

namespace Src\Api\History\Infrastructure;

use App\Models\History;
use Src\Api\History\Domain\HistoryEntity;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\History\Domain\ValueObjects\HistoryId;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class HistoryEloquentRepository implements HistoryRepository
{
    public function saveHistory(HistoryEntity $historyEntity)
    {
        return History::create($historyEntity->toArray());
    }

    public function getHistories(UserId $userId)
    {
        return History::join('users', 'users.id', '=', 'histories.user_id')
            ->select('users.*', 'histories.*')
            ->where([
                ['user_id', $userId->value()],
                ['histories.active', intval(true)]
            ])
            ->latest('histories.created_at')
            ->get();
    }

    public function changeHistoryStatus(HistoryId $historyId, Status $status)
    {
        History::where('id', $historyId->value())
            ->update(
                ['active' => intval($status->value())]
            );
    }
}
