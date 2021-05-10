<?php

declare(strict_types=1);

namespace Src\Api\Likes\Application\LikeToggler;

use Src\Api\Shared\Domain\Contracts\Command;

final class ToggleLikeCommand implements Command
{
    private int $userId;
    private int $postId;

    public function __construct(
        int $userId,
        int $postId
    ) {
        $this->userId = $userId;
        $this->postId = $postId;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /***
     * ge the valeu of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }
}
