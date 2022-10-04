<?php

namespace Src\Api\Reports\Domain;

use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\Contracts\ReportElementStrategy;

final class ReportElementContext
{
    private ReportElementStrategy $reportElementStrategy;

    public function __construct(ReportElementStrategy $reportElementStrategy)
    {
        $this->reportElementStrategy = $reportElementStrategy;
    }

    public function executeValidationStrtegy(ReportElementId $reportElementId)
    {
        $this->reportElementStrategy->executeElementValidtion($reportElementId);
    }

    public function executeGetterStrategy()
    {
        return $this->reportElementStrategy->executeElementGetter();
    }

    public function executePunishStrategy(ReportElementId $reportElementId)
    {
        $this->reportElementStrategy->executeElementPunish($reportElementId);
    }
}
