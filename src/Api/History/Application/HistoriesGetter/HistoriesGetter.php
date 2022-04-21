<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoriesGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class HistoriesGetter
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
