<?php

namespace Src\Api\Reports\Application;

use Src\Api\Post\Domain\ValueObjects\PostId;
use Src\Api\Post\Application\ListReportedPost;
use Src\Api\Shared\Domain\ValueObjects\Status;
use Src\Api\Post\Domain\Contracts\PostRepository;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class PostReportStrategy implements ReportElementStrategy
{
    private ?PostValidation $postValidation;
    private ?ListReportedPost $listReportedPost;
    private ?PostRepository $postRepository;

    public function __construct(
        ?PostValidation $postValidation,
        ?ListReportedPost $listReportedPost,
        ?PostRepository $postRepository
    ) {
        $this->postValidation = $postValidation;
        $this->listReportedPost = $listReportedPost;
        $this->postRepository = $postRepository;
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

    public function executeElementPunish(ReportElementId $reportElementId)
    {
        $postId = new PostId($reportElementId->value());
        $status = new Status(false);

        $this->postRepository->changePostStatus($postId, $status);
    }
}
