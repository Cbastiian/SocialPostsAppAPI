<?php

namespace Src\Api\Reports\Infrastructure;

use App\Models\Report;
use App\Models\ReportReasons;
use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\Constants\ReportConstants;
use Src\Api\Reports\Domain\Contracts\ReportValidation;
use Src\Api\Reports\Domain\Exceptions\ReportNotExistError;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;
use Src\Api\Reports\Domain\Exceptions\ReportElementNotValidError;
use Src\Api\Reports\Domain\Exceptions\SameUserReportLimitError;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\User\Domain\ValueObjects\UserId;

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

    public function throwIfSameUserReporLimit(ReportElementType $reportElementType, ReportElementId $reportElementId, UserId $userId, ReasonId $reasonId)
    {

        $userReportLimit = Report::where([
            ['report_user_id', $userId->value()],
            ['reason_id', $reasonId->value()],
            ['report_element_type', $reportElementType->value()],
            ['report_element_id', $reportElementId->value()]
        ])->count();

        $sameUserReportLimit = ReportReasons::where('id', $reasonId->value())
            ->first();

        if ($userReportLimit >= $sameUserReportLimit->same_user_report_limit) throw new SameUserReportLimitError(
            $reasonId,
            $reportElementType,
            $userId
        );
    }

    public function findReportId(ReportId $reportId)
    {
        return Report::where('id', $reportId->value())->first();
    }
}
