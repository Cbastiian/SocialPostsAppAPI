<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentStatusChanger;

use Src\Api\Shared\Domain\Contracts\Command;

final class ChangeCommentStatusCommand implements Command
{
    private int $commentId;
    private int $userId;
    private bool $status;

    public function __construct(
        int $commentId,
        int $userId,
        bool $status
    ) {
        $this->commentId = $commentId;
        $this->userId = $userId;
        $this->status = $status;
    }

    /***
     * get the value of commentId
     */
    public function getcommentId()
    {
        return $this->commentId;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /***
     * get the value of $status
     */
    public function getstatus()
    {
        return $this->status;
    }
}
