<?php

namespace Src\Api\Reports\Infrastructure;

use Src\Api\Reports\Domain\Constants\ReportConstants;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\Reports\Domain\Exceptions\ReportElementNotValidError;

final class ReportValidationRepository implements ReportValidation
{
    public function throwIfReportEntityInvalid(ReportElementType $reportElementType)
    {
        if (!in_array($reportElementType->value(), ReportConstants::REPORT_ENTITIES)) throw new ReportElementNotValidError($reportElementType);
    }
}
