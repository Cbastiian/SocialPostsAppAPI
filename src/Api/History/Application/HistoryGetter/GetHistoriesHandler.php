<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetHistoriesHandler implements CommandHandler
{
    private HistoryGetter $historyGetter;
    private UserRepository $userRepository;

    public function __construct(
        HistoryGetter $historyGetter,
        UserRepository $userRepository
    ) {
        $this->historyGetter = $historyGetter;
        $this->userRepository = $userRepository;
    }

    public function execute($command)
    {
        $histories = array();

        $followings = $this->userRepository->getFollowings();

        foreach ($followings as $user) {
            $userId = new UserId($user->id);
            array_push($histories, [$user->id => $this->historyGetter->__invoke($userId)]);
        }

        return $histories;
    }
}
