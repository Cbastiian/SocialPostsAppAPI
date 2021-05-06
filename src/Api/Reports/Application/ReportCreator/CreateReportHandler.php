<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Application\ListReportedPost;
use Src\Api\User\Application\ListReportedUsers;
use Src\Api\Reports\Domain\ReportElementContext;
use Src\Api\Post\Domain\Contracts\PostValidation;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Reports\Application\PostReportStrategy;
use Src\Api\Reports\Application\UserReportStrategy;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Comment\Application\ListReportedComments;
use Src\Api\Reports\Application\CommentReportStrategy;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Comment\Domain\Contracts\CommentValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class CreateReportHandler implements CommandHandler
{
    private ReportCreator $reportCreator;
    private ReportValidation $reportValidation;
    private CommentValidation $commentValidation;
    private PostValidation $postValidation;
    private UserValidation $userValidation;
    private ListReportedComments $listReportedComments;
    private ListReportedPost $listReportedPost;
    private ListReportedUsers $listReportedUsers;

    public function __construct(
        ReportCreator $reportCreator,
        ReportValidation $reportValidation,
        CommentValidation $commentValidation,
        PostValidation $postValidation,
        UserValidation $userValidation,
        ListReportedComments $listReportedComments,
        ListReportedPost $listReportedPost,
        ListReportedUsers $listReportedUsers
    ) {
        $this->reportCreator = $reportCreator;
        $this->reportValidation = $reportValidation;
        $this->commentValidation = $commentValidation;
        $this->postValidation = $postValidation;
        $this->userValidation = $userValidation;
        $this->listReportedComments = $listReportedComments;
        $this->listReportedPost = $listReportedPost;
        $this->listReportedUsers = $listReportedUsers;
    }

    public function execute($command)
    {
        $reasonId = new ReasonId($command->getReasonId());
        $reportElementType = new ReportElementType($command->getReportElementType());
        $reportElementId = new ReportElementId($command->getReportElementId());
        $reportUserId = new UserId($command->getReportUserId());

        $this->reportValidation->throwIfReportEntityInvalid($reportElementType);

        $strategyData = $this->getStrategy($reportElementType);

        $context = new ReportElementContext($strategyData);

        $context->executeValidationStrtegy($reportElementId);

        return $this->reportCreator->__invoke($reasonId, $reportElementType, $reportElementId, $reportUserId);
    }

    public function getStrategy(ReportElementType $reportElementType)
    {
        switch ($reportElementType->value()) {
            case 'COMMENT':
                $strategy =  new CommentReportStrategy($this->commentValidation, $this->listReportedComments);
                break;
            case 'POST':
                $strategy =  new PostReportStrategy($this->postValidation, $this->listReportedPost);
                break;
            case 'USER':
                $strategy = new UserReportStrategy($this->userValidation, $this->listReportedUsers);
                break;
        }

        return $strategy;
    }
}
