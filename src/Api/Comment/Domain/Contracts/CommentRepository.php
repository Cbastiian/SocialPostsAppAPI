<?php

namespace Src\Api\Comment\Domain\Contracts;

use Src\Api\Comment\Domain\CommentEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Comment\Domain\ValueObjects\CommentId;

interface CommentRepository
{
    public function saveComment(CommentEntity $commentEntity);
    public function getPostComments(PostId $postId);
    public function getReportedComments();
    public function changeCommentStatus(CommentId $commentId, Status $status);
}
