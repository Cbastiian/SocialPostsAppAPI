<?php

namespace Src\Api\Comment\Domain\Contracts;

use Src\Api\Comment\Domain\ValueObjects\CommentId;

interface CommentValidation
{
    public function throwIfCommentNotExist(CommentId $commentId);
}
