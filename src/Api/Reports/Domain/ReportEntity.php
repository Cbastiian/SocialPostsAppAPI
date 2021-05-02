<?php

declare(strict_types=1);

namespace Src\Api\Reports\Domain;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Reports\Domain\ValueObjects\ReasonId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementId;
use Src\Api\Reports\Domain\ValueObjects\ReportElementType;

final class ReportEntity
{
    private ReasonId $reasonId;
    private ReportElementType $reportElementType;
    private ReportElementId $reportElementId;
    private UserId $reposrtUserId;

    private function __construct(
        ReasonId $reasonId,
        ReportElementType $reportElementType,
        ReportElementId $reportElementId,
        UserId $reposrtUserId
    ) {
        $this->reasonId = $reasonId;
        $this->reportElementType = $reportElementType;
        $this->reportElementId = $reportElementId;
        $this->reposrtUserId = $reposrtUserId;
    }

    public static function create(
        ReasonId $reasonId,
        ReportElementType $reportElementType,
        ReportElementId $reportElementId,
        UserId $reposrtUserId
    ) {
        return new self(
            $reasonId,
            $reportElementType,
            $reportElementId,
            $reposrtUserId
        );
    }

    /***
     * get the value of reasonId
     */
    public function getReasonId(): ReasonId
    {
        return $this->reasonId;
    }

    /***
     * get the value of reportElementType
     */
    public function getReportElementType(): ReportElementType
    {
        return $this->reportElementType;
    }

    /***
     * get the value of reportElementId
     */
    public function getReportElementId(): ReportElementId
    {
        return $this->reportElementId;
    }

    /***
     * get the value of reportUserId
     */
    public function getReportUserId(): UserId
    {
        return $this->reposrtUserId;
    }

    public function toArray(): array
    {
        return [
            'reason_id' => $this->getReasonId()->value(),
            'report_element_type' => $this->getReportElementType()->value(),
            'report_element_id' => $this->getReportElementId()->value(),
            'report_user_id' => $this->getReportUserId()->value()
        ];
    }
}
