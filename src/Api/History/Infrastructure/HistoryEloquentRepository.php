<?php

namespace Src\Api\History\Infrastructure;

use Carbon\Carbon;
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

    public function changeHistoryStatus(HistoryId $historyId, Status $status)
    {
        History::where('id', $historyId->value())
            ->update(
                ['active' => intval($status->value())]
            );
    }


    public function getHistories(UserId $userId)
    {
        return History::where([
            ['user_id', $userId->value()],
            ['active', intval(true)]
        ])
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->get();
    }
}
