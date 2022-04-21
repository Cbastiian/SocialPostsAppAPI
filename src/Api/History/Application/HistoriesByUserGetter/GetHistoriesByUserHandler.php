<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoriesByUserGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\History\Domain\Contracts\HistoryRepository;

final class GetHistoriesByUserHandler implements CommandHandler
{
    private HistoryRepository $historyRepository;
    private UserValidation $userValidation;

    public function __construct(
        HistoryRepository $historyRepository,
        UserValidation $userValidation
    ) {
        $this->historyRepository = $historyRepository;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $userId = new UserId($command->getUserId());
        $this->userValidation->throwIfUserNotExist($userId);

        return $this->historyRepository->getHistories($userId);
    }
}
