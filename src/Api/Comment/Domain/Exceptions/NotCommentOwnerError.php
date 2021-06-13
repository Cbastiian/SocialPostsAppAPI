<?php

namespace Src\Api\Comment\Domain\Exceptions;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Product\Domain\ValueObjects\ProductId;

final class NotCommentOwnerError extends DomainError
{
    private CommentId $commentId;
    private UserId $userId;

    public function __construct(
        CommentId $commentId,
        UserId $userId
    ) {
        $this->commentId = $commentId;
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'NOT_COMMENT_OWNER';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId->value() . ' is not the owner of the comment with id ' . $this->commentId->value();
    }
}
