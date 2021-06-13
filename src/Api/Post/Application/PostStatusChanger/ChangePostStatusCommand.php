<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostStatusChanger;

use Src\Api\Shared\Domain\Contracts\Command;

final class ChangePostStatusCommand implements Command
{
    private int $postId;
    private int $userId;
    private bool $status;

    public function __construct(
        int $postId,
        int $userId,
        bool $status
    ) {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->status = $status;
    }

    /***
     * get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
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
     */
    public function getStatus()
    {
        return $this->status;
    }
}
