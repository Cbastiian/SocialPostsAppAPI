<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoriesGetter;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetHistoriesHandler implements CommandHandler
{
    private HistoriesGetter $historiesGetter;
    private UserRepository $userRepository;

    public function __construct(
        HistoriesGetter $historiesGetter,
        UserRepository $userRepository
    ) {
        $this->historiesGetter = $historiesGetter;
        $this->userRepository = $userRepository;
    }

    public function execute($command)
    {
        $histories = array();

        $followings = $this->userRepository->getFollowings();

        foreach ($followings as $user) {
            $userId = new UserId($user->id);
            $user_histories = $this->historiesGetter->__invoke($userId);

            if (count($user_histories) > 0) {
                $remove = array("email_verified_at", "bio", "active", "created_at", "updated_at", "pivot");
                foreach ($remove as $key) {
                    unset($user->$key);
                }

                array_push($histories, [
                    'user_info' => $user,
                    'histories' => [...$user_histories]
                ]);
            }
        }

        return $histories;
    }
}
