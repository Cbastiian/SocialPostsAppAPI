<?php

namespace Src\Api\Post\Domain\Exceptions;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\Exceptions\DomainError;

final class NotPostOwnerError extends DomainError
{
    private PostId $postId;
    private UserId $userId;

    public function __construct(
        PostId $postId,
        UserId $userId
    ) {
        $this->postId = $postId;
        $this->userId = $userId;
    }

    public function errorCode(): string
    {
        return 'NOT_POST_OWNER';
    }

    public function errorMessage(): string
    {
        return 'The user with id ' . $this->userId->value() . ' is not the owner of the post with id ' . $this->postId->value();
    }
}
