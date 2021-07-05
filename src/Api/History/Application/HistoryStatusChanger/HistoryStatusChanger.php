<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryStatusChanger;

use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\History\Domain\ValueObjects\HistoryId;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class HistoryStatusChanger
{
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function __invoke(
        HistoryId $historyId,
        Status $status
    ) {
        $this->historyRepository->changeHistoryStatus(
            $historyId,
            $status
        );
    }
}
