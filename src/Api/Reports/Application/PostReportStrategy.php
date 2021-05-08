<?php

namespace Src\Api\Reports\Application;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Post\Application\ListReportedPost;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class PostReportStrategy implements ReportElementStrategy
{
    private PostValidation $postValidation;
    private ListReportedPost $listReportedPost;

    public function __construct(
        ?PostValidation $postValidation,
        ListReportedPost $listReportedPost
    ) {
        $this->postValidation = $postValidation;
        $this->listReportedPost = $listReportedPost;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $postId = new PostId($reportElementId->value());

        $this->postValidation->throwIfPostIdNotExistError($postId);
    }

    public function executeElementGetter()
    {
        return $this->listReportedPost->__invoke();
    }
}
