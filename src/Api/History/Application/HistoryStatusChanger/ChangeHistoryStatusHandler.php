<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryStatusChanger;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\History\Domain\ValueObjects\HistoryId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\History\Domain\Contracts\HistoryValidation;

final class ChangeHistoryStatusHandler implements CommandHandler
{
    private HistoryStatusChanger $historyStatusChanger;
    private HistoryValidation $historyValidation;

    public function __construct(
        HistoryStatusChanger $historyStatusChanger,
        HistoryValidation $historyValidation
    ) {
        $this->historyStatusChanger = $historyStatusChanger;
        $this->historyValidation = $historyValidation;
    }

    public function execute($command)
    {
        $historyId = new HistoryId($command->getHistoryId());
        $userId = new UserId($command->getUserId());
        $status = new Status($command->getStatus());

        $this->historyValidation->throwIfHistoryNotExist($historyId);
        $this->historyValidation->throwIfNotHistoryOwner($historyId, $userId);

        $this->historyStatusChanger->__invoke($historyId, $status);
    }
}
