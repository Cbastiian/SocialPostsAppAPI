<?php

namespace Src\Api\Comment\Domain\Exceptions;

use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Comment\Domain\ValueObjects\CommentId;

final class CommentNotExistError extends DomainError
{
    private CommentId $commentId;

    public function __construct(CommentId $commentId)
    {
        $this->commentId = $commentId;
    }

    public function errorCode(): string
    {
        return 'COMMENT_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The comment with id ' . $this->commentId->value() . ' not exist';
    }
}
