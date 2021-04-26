<?php

namespace Src\Api\Post\Domain\Contracts;

use Src\Api\Post\Domain\PostEntity;
use Src\Api\User\Domain\ValueObjects\UserId;

interface PostRepository
{
    public function savePost(PostEntity $postEntity);
    public function getPosts(UserId $userId);
}
