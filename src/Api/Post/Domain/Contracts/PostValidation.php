<?php

namespace Src\Api\Post\Domain\Contracts;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;

interface PostValidation
{
    public function throwIfPostIdNotExistError(PostId $postId);
    public function throwIfNotPostOwner(PostId $postId, UserId $userId);
}
