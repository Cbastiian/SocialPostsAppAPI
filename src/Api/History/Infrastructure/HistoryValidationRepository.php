<?php

declare(strict_types=1);

namespace Src\Api\History\Infrastructure;

use App\Models\History;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\History\Domain\ValueObjects\HistoryId;
use Src\Api\History\Domain\Contracts\HistoryValidation;
use Src\Api\History\Domain\Exceptions\HistoryNotExistError;
use Src\Api\History\Domain\Exceptions\NotHistoryOwnerError;

final class HistoryValidationRepository implements HistoryValidation
{
    public function throwIfHistoryNotExist(HistoryId $historyId)
    {
        $history = $this->findHistoryById($historyId);

        if (!$history) throw new HistoryNotExistError($historyId);
    }

    public function throwIfNotHistoryOwner(HistoryId $historyId, UserId $userId)
    {
        $history = $this->findHistoryById($historyId);

        if ($history->user_id != $userId->value()) throw new NotHistoryOwnerError($historyId, $userId);
    }

    public function findHistoryById(HistoryId $historyId)
    {
        return History::where('id', $historyId->value())->first();
    }
}
