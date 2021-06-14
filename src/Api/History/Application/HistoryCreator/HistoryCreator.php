<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryCreator;

use Src\Api\History\Domain\HistoryEntity;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\History\Domain\ValueObjects\Comment;
use Src\Api\History\Domain\ValueObjects\HistoryFile;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class HistoryCreator
{
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function __invoke(
        Comment $comment,
        UserId $userId,
        HistoryFile $historyFile
    ) {
        $history = HistoryEntity::create($comment, $userId, $historyFile);

        return $this->historyRepository->saveHistory($history);
    }
}
