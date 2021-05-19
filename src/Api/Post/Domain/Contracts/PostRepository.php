<?php

namespace Src\Api\Post\Domain\Contracts;

use Src\Api\Post\Domain\PostEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Status;

interface PostRepository
{
    public function savePost(PostEntity $postEntity);
    public function getPosts(UserId $userId);
    public function getReportedPost();
    public function changePostStatus(PostId $postId, Status $status);
    public function findById(PostId $postId);
}
