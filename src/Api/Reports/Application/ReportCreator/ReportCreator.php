<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportCreator;

use Src\Api\Reports\Domain\ReportEntity;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class ReportCreator
{
    private ReportsRepository $reportReposiotry;

    public function __construct(ReportsRepository $reportReposiotry)
    {
        $this->reportReposiotry = $reportReposiotry;
    }

    public function __invoke(
        ReasonId $reasonId,
        ReportElementType $reportElementType,
        ReportElementId $reportElementId,
        UserId $reportUserId
    ) {
        $report = ReportEntity::create($reasonId, $reportElementType, $reportElementId, $reportUserId);

        return $this->reportReposiotry->createReport($report);
    }
}
