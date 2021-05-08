<?php

namespace Src\Api\Comment\Infrastructure;

use App\Models\Comment;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Comment\Domain\Exceptions\CommentNotExistError;

final class CommentValidationRepository implements CommentValidation
{
    public function throwIfCommentNotExist(CommentId $commentId)
    {
        $comment = $this->findCommentId($commentId);

        if ($comment === null) throw new CommentNotExistError($commentId);
    }

    public function findCommentId(CommentId $commentId)
    {
        return Comment::where('id', $commentId->value())->first();
    }
}
