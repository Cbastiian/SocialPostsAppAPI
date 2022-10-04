<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportPunisher;

use Src\Api\Reports\Domain\ReportElementContext;
use Src\Api\Post\Domain\Contracts\PostRepository;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\Reports\Application\PostReportStrategy;
use Src\Api\Reports\Application\UserReportStrategy;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Reports\Application\CommentReportStrategy;
use Src\Api\Reports\Application\ProductReportStrategy;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Comment\Domain\Contracts\CommentRepository;
use Src\Api\Product\Domain\Contracts\ProductRepository;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishMessage;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsPunished;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsAutoPunished;

final class PunishReportHandler implements CommandHandler
{
    private ReportValidation $reportValidation;
    private ReportsRepository $reportsRepository;
    private ReportPunisher $reportPunisher;
    private CommentRepository $commentRepository;
    private PostRepository $postRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;

    public function __construct(
        ReportValidation $reportValidation,
        ReportsRepository $reportsRepository,
        ReportPunisher $reportPunisher,
        CommentRepository $commentRepository,
        PostRepository $postRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    ) {
        $this->reportValidation = $reportValidation;
        $this->reportsRepository = $reportsRepository;
        $this->reportPunisher = $reportPunisher;
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function execute($command)
    {
        $reportId = new ReportId($command->getReportId());
        $reportElementId = new ReportElementId($command->getReportId());
        $message = new ReportPunishMessage($command->getMessage());
        $isPunished = new ReportPunishIsPunished($command->getIsPunished());
        $isAutoPunished = new ReportPunishIsAutoPunished(false);

        $this->reportValidation->throwIfReportNotExist($reportId);

        if ($isPunished->value() == true) {
            $report = $this->reportsRepository->findReportId($reportId);

            $reportElementType = new ReportElementType($report->report_element_type);
            $this->reportValidation->throwIfReportEntityInvalid($reportElementType);

            $strategyData = $this->getStrategy($reportElementType);
            $context = new ReportElementContext($strategyData);

            $context->executePunishStrategy($reportElementId);
        }

        return $this->reportPunisher->__invoke($reportId, $message, $isPunished, $isAutoPunished);
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
