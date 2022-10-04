<?php

declare(strict_types=1);

namespace Src\Api\Reports\Application\ReportPunisher;

use Src\Api\Shared\Domain\Contracts\Command;

final class PunishReportCommand implements Command
{
    private int $reportId;
    private string $message;
    private bool $isPunished;

    public function __construct(
        int $reportId,
        string $message,
        bool $isPunished
    ) {
        $this->reportId = $reportId;
        $this->message = $message;
        $this->isPunished = $isPunished;
    }

    /***
     * get the value of reportId
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /***
     * get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /***
     * get the value of isPunished
     */
    public function getIsPunished()
    {
        return $this->isPunished;
    }
}
