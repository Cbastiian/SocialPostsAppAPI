<?php

namespace Src\Api\Reports\Domain\Contracts;

use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

interface ReportValidation
{
    public function throwIfReportEntityInvalid(ReportElementType $reportElementType);
}
