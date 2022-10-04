<?php

namespace Src\Api\Reports\Application;

use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Comment\Domain\ValueObjects\CommentId;
use Src\Api\Comment\Application\ListReportedComments;
use Src\Api\Comment\Domain\Contracts\CommentRepository;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class CommentReportStrategy implements ReportElementStrategy
{
    public ?CommentValidation $commentValidation;
    public ?ListReportedComments $listReportedComments;
    public ?CommentRepository $commentRepository;

    public function __construct(
        ?CommentValidation $commentValidation,
        ?ListReportedComments $listReportedComments,
        ?CommentRepository $commentRepository
    ) {
        $this->commentValidation = $commentValidation;
        $this->listReportedComments = $listReportedComments;
        $this->commentRepository = $commentRepository;
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

    public function executeElementPunish(ReportElementId $reportElementId)
    {
        $commentId = new CommentId($reportElementId->value());
        $status = new Status(false);

        $this->commentRepository->changeCommentStatus($commentId, $status);
    }
}
