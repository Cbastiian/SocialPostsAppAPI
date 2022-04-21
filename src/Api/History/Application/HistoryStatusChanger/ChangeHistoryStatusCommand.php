<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryStatusChanger;

use Src\Api\Shared\Domain\Contracts\Command;

final class ChangeHistoryStatusCommand implements Command
{
    private int $historyId;
    private int $userId;
    private bool $status;

    public function __construct(
        int $historyId,
        int $userId,
        bool $status
    ) {
        $this->historyId =  $historyId;
        $this->userId = $userId;
        $this->status =  $status;
    }

    /***
     * get the value of historyId
     */
    public function getHistoryId()
    {
        return $this->historyId;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /***
     * get the value of status
     *  
     */
    public function getStatus()
    {
        return $this->status;
    }
}
