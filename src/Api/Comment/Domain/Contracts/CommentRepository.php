<?php

namespace Src\Api\Comment\Domain\Contracts;

use Src\Api\Comment\Domain\CommentEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;

interface CommentRepository
{
    public function saveComment(CommentEntity $commentEntity);
    public function getPostComments(PostId $postId);
}
