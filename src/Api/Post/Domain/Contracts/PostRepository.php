<?php

namespace Src\Api\Post\Domain\Contracts;

use Src\Api\Post\Domain\PostEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;

interface PostRepository
{
    public function savePost(PostEntity $postEntity);
    public function getPosts(UserId $userId);
    public function getReportedPost();
    public function findById(PostId $postId);
}
