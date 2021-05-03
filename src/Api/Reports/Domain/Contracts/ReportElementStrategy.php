<?php

namespace Src\Api\Reports\Domain\Contracts;

use Src\Api\Reports\Domain\ValueObjects\ReportElementId;

interface ReportElementStrategy
{
    public function executeElementValidtion(ReportElementId $reportElementId);
}
