<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class HistoryGetter
{
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function __invoke(UserId $userId)
    {
        return $this->historyRepository->getHistories($userId);
    }
}
