<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentCreator;

use Src\Api\Comment\Domain\CommentEntity;
use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\ValueObjects\Content;
use Src\Api\Comment\Domain\Contracts\CommentRepository;
use Src\Api\Comment\Domain\ValueObjects\CommentatorUserId;

final class CommentCreator
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function __invoke(
        Content $content,
        PostId $postId,
        UserId $commentatorUserId
    ) {
        $comment = CommentEntity::create($content, $postId, $commentatorUserId);

        return $this->commentRepository->saveComment($comment);
    }
}
