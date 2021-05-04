<?php

namespace Src\Api\Reports\Infrastructure;

use App\Models\Report;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\Constants\ReportConstants;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Reports\Domain\Exceptions\ReportNotExistError;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\Reports\Domain\Exceptions\ReportElementNotValidError;

final class ReportValidationRepository implements ReportValidation
{
    public function throwIfReportEntityInvalid(ReportElementType $reportElementType)
    {
        if (!in_array($reportElementType->value(), ReportConstants::REPORT_ENTITIES)) throw new ReportElementNotValidError($reportElementType);
    }

    public function throwIfReportNotExist(ReportId $reportId)
    {
        $report = $this->findReportId($reportId);

        if ($report === null) throw new ReportNotExistError($reportId);
    }

    public function findReportId(ReportId $reportId)
    {
        return Report::where('id', $reportId->value())->first();
    }
}
