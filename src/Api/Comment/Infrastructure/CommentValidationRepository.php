<?php

namespace Src\Api\Comment\Infrastructure;

use App\Models\Comment;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Comment\Domain\Exceptions\CommentNotExistError;
use Src\Api\Comment\Domain\Exceptions\NotCommentOwnerError;

final class CommentValidationRepository implements CommentValidation
{
    public function throwIfCommentNotExist(CommentId $commentId)
    {
        $comment = $this->findCommentId($commentId);

        if ($comment === null) throw new CommentNotExistError($commentId);
    }

    public function throwIfNotCommentOwner(CommentId $commentId, UserId $userId)
    {
        $comment = $this->findCommentId($commentId);

        if ($comment->comentator_user_id != $userId->value()) throw new NotCommentOwnerError($commentId, $userId);
    }

    public function findCommentId(CommentId $commentId)
    {
        return Comment::where('id', $commentId->value())->first();
    }
}
