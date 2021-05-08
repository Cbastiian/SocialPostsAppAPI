<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportCreator;

use Src\Api\Shared\Domain\Contracts\Command;

final class CreateReportCommand implements Command
{
    private int $reasonId;
    private string $reportElementType;
    private int $reportElementId;
    private int $reportUserId;

    public function __construct(
        int $reasonId,
        string $reportElementType,
        int $reportElementId,
        int $reportUserId
    ) {
        $this->reasonId = $reasonId;
        $this->reportElementType = $reportElementType;
        $this->reportElementId = $reportElementId;
        $this->reportUserId = $reportUserId;
    }

    /***
     * get the value of reasonId
     */
    public function getReasonId()
    {
        return $this->reasonId;
    }

    /***
     * get the value of reportElementType
     */
    public function getReportElementType()
    {
        return $this->reportElementType;
    }

    /***
     * get the value of reportElementId
     */
    public function getReportElementId()
    {
        return $this->reportElementId;
    }

    /***
     * get the value of reportUserId;
     */
    public function getReportUserId()
    {
        return $this->reportUserId;
    }
}
