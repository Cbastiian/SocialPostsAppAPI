<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserBioUpdater;

use Src\Api\Shared\Domain\Contracts\Command;

final class UpdateUserBioCommand implements Command
{
    private int $userId;
    private string $bio;

    public function __construct(
        int $userId,
        string $bio
    ) {
        $this->userId = $userId;
        $this->bio = $bio;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /***
     * get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }
}
