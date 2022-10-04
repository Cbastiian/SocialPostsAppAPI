<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportCreator;

use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\Contracts\ReportsRepository;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class AutopunishChecker
{
    private ReportsRepository $reportsRepository;

    public function __construct(ReportsRepository $reportsRepository)
    {
        $this->reportsRepository = $reportsRepository;
    }

    public function __invoke(
        ReportElementId $reportElementId,
        ReportElementType $reportElementType,
        ReasonId $reasonId
    ) {
        $reasonData = $this->reportsRepository->getReportReasonData($reasonId);

        $autopunishLimit = $reasonData->auto_punish_limit;
        $reportsNumber = $this->reportsRepository->getReportsByReaasonNumber($reportElementId, $reportElementType, $reasonId);
    }
}
