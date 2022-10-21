<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportCreator;

use Src\Api\Comment\Domain\Contracts\CommentRepository;
use Src\Api\Post\Domain\Contracts\PostRepository;
use Src\Api\Product\Domain\Contracts\ProductRepository;
use Src\Api\Reports\Application\CommentReportStrategy;
use Src\Api\Reports\Application\PostReportStrategy;
use Src\Api\Reports\Application\ProductReportStrategy;
use Src\Api\Reports\Application\ReportPunisher\ReportPunisher;
use Src\Api\Reports\Application\UserReportStrategy;
use Src\Api\Reports\Domain\Constants\ReportConstants;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Domain\ReportElementContext;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsAutoPunished as IsAutoPunished;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsPunished as IsPunished;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishMessage as Message;
use Src\Api\User\Domain\Contracts\UserRepository;

final class AutopunishChecker
{
    private ReportsRepository $reportsRepository;
    private ReportPunisher $reportPunisher;
    private CommentRepository $commentRepository;
    private PostRepository $postRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;

    public function __construct(
        ReportsRepository $reportsRepository,
        ReportPunisher $reportPunisher,
        CommentRepository $commentRepository,
        PostRepository $postRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    ) {
        $this->reportsRepository = $reportsRepository;
        $this->reportPunisher = $reportPunisher;
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function __invoke(
        ReportElementId $reportElementId,
        ReportElementType $reportElementType,
        ReasonId $reasonId,
        ReportId $reportId
    ) {
        $reasonData = $this->reportsRepository->getReportReasonData($reasonId);

        $autopunishLimit = $reasonData->auto_punish_limit;
        $reportsNumber = $this->reportsRepository->getReportsByReaasonNumber($reportElementId, $reportElementType, $reasonId);

        if ($reportsNumber >= $autopunishLimit) {
            $isPunished = new IsPunished(true);
            $isAutoPunished = new IsAutoPunished(true);
            $message = new Message(ReportConstants::REPORT_AUTO_PUNISH_MESSAGE . `'` . $reasonData->description . `'`);

            $strategyData = $this->getStrategy($reportElementType);
            $context = new ReportElementContext($strategyData);

            $context->executePunishStrategy($reportElementId);

            return $this->reportPunisher->__invoke($reportId, $message, $isPunished, $isAutoPunished);
        }

        return ['auto_punish' =>  false];
    }

    public function getStrategy(ReportElementType $reportElementType)
    {
        switch ($reportElementType->value()) {
            case 'COMMENT':
                $strategy =  new CommentReportStrategy(null, null, $this->commentRepository);
                break;
            case 'POST':
                $strategy =  new PostReportStrategy(null, null, $this->postRepository);
                break;
            case 'USER':
                $strategy = new UserReportStrategy(null, null, $this->userRepository);
                break;
            case 'PRODUCT':
                $strategy = new ProductReportStrategy(null, null, $this->productRepository);
                break;
        }

        return $strategy;
    }
}
