<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentStatusChanger;

use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Domain\Contracts\CommentRepository;

final class CommentStatusChanger
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function __invoke(CommentId $commentId, Status $status)
    {
        $this->commentRepository->changeCommentStatus($commentId, $status);
    }
}
