<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoriesByUserGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetHistoriesByUserCommand implements Command
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
