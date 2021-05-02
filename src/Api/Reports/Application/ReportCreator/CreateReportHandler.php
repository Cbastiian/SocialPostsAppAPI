<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class CreateReportHandler implements CommandHandler
{
    private ReportCreator $reportCreator;

    public function __construct(ReportCreator $reportCreator)
    {
        $this->reportCreator = $reportCreator;
    }

    public function execute($command)
    {
        $reasonId = new ReasonId($command->getReasonId());
        $reportElementType = new ReportElementType($command->getReportElementType());
        $reportElementId = new ReportElementId($command->getReportElementId());
        $reportUserId = new UserId($command->getReportUserId());

        return $this->reportCreator->__invoke($reasonId, $reportElementType, $reportElementId, $reportUserId);
    }
}
