<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentsGetter;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Comment\Domain\Contracts\CommentRepository;

final class CommentsGetter
{
    public CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function __invoke(PostId $postId)
    {
        return $this->commentRepository->getPostComments($postId);
    }
}
