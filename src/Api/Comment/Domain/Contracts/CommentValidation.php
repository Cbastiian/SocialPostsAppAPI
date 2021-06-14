<?php

namespace Src\Api\Comment\Domain\Contracts;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Comment\Domain\ValueObjects\CommentId;

interface CommentValidation
{
    public function throwIfCommentNotExist(CommentId $commentId);
    public function throwIfNotCommentOwner(CommentId $commentId, UserId $userId);
}
