<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportGetter;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class GetReportsHandler implements CommandHandler
{
    private ReportGetter $reportGetter;
    private ReportValidation $reportValidation;

    public function __construct(ReportGetter $reportGetter, ReportValidation $reportValidation)
    {
        $this->reportGetter = $reportGetter;
        $this->reportValidation = $reportValidation;
    }

    public function execute($command)
    {
        $reportElementType = new ReportElementType($command->getReportElementType());
        $this->reportValidation->throwIfReportEntityInvalid($reportElementType);

        return $this->reportGetter->__invoke($reportElementType);
    }
}
