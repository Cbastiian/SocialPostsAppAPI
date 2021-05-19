<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application\CommentStatusChanger;

use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Comment\Domain\Contracts\CommentValidation;

final class ChangeCommentStatusHandler implements CommandHandler
{
    private CommentStatusChanger $commentStatusChanger;
    private CommentValidation $commentValidation;

    public function __construct(
        CommentStatusChanger $commentStatusChanger,
        CommentValidation $commentValidation
    ) {
        $this->commentStatusChanger = $commentStatusChanger;
        $this->commentValidation = $commentValidation;
    }

    public function execute($command)
    {
        $commentId = new CommentId($command->getCommentId());
        $status = new Status($command->getStatus());

        $this->commentValidation->throwIfCommentNotExist($commentId);

        $this->commentStatusChanger->__invoke($commentId, $status);
    }
}
