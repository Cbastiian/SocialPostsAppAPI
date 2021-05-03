<?php

namespace Src\Api\Reports\Application;

use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class CommentReportStrategy implements ReportElementStrategy
{
    public CommentValidation $commentValidation;

    public function __construct(CommentValidation $commentValidation)
    {
        $this->commentValidation = $commentValidation;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $commentId = new CommentId($reportElementId->value());

        $this->commentValidation->throwIfCommentNotExist($commentId);
    }
}
