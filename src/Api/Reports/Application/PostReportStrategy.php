<?php

namespace Src\Api\Reports\Application;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class PostReportStrategy implements ReportElementStrategy
{
    private PostValidation $postValidation;

    public function __construct(PostValidation $postValidation)
    {
        $this->postValidation = $postValidation;
    }

    public function executeElementValidtion(ReportElementId $reportElementId)
    {
        $postId = new PostId($reportElementId->value());

        $this->postValidation->throwIfPostIdNotExistError($postId);
    }
}
