<?php

namespace Src\Api\Reports\Application;

use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Application\ListReportedComments;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class CommentReportStrategy implements ReportElementStrategy
{
    public CommentValidation $commentValidation;
    public ListReportedComments $listReportedComments;

    public function __construct(
        ?CommentValidation $commentValidation,
        ?ListReportedComments $listReportedComments
    ) {
        $this->commentValidation = $commentValidation;
        $this->listReportedComments = $listReportedComments;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $commentId = new CommentId($reportElementId->value());

        $this->commentValidation->throwIfCommentNotExist($commentId);
    }

    public function executeElementGetter()
    {
        return $this->listReportedComments->__invoke();
    }
}
