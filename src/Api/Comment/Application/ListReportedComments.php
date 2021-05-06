<?php

declare(strict_types=1);

namespace Src\Api\Comment\Application;

use Src\Api\Comment\Domain\Contracts\CommentRepository;

final class ListReportedComments
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function __invoke()
    {
        return $this->commentRepository->getReportedComments();
    }
}
