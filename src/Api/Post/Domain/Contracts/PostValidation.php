<?php

namespace Src\Api\Post\Domain\Contracts;

use Src\Api\Post\Domain\ValueObjects\PostId;

interface PostValidation
{
    public function throwIfPostIdNotExistError(PostId $postId);
}
