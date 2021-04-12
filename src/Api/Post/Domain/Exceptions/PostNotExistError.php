<?php

declare(strict_types=1);

namespace Src\Api\Post\Domain\Exceptions;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Shared\Domain\Exceptions\DomainError;

final class PostNotExistError extends DomainError
{
    private PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }

    public function errorCode(): string
    {
        return 'POST_NOT_EXIST';
    }

    public function errorMessage(): string
    {
        return 'The post with id ' . $this->postId->value() . ' no exist';
    }
}
