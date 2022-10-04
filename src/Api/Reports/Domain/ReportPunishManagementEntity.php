<?php

namespace Src\Api\Reports\Domain;


use Src\Api\Reports\Domain\ValueObjects\ReportId;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishMessage as Message;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsPunished as IsPunished;
use Src\Api\Reports\Domain\ValueObjects\ReportPunishIsAutoPunished as IsAutoPunished;

final class ReportPunishManagementEntity
{
    private ReportId $reportId;
    private Message $message;
    private IsPunished $isPunished;
    private IsAutoPunished $isAutoPunished;

    public function __construct(
        ReportId $reportId,
        Message $message,
        IsPunished $isPunished,
        IsAutoPunished $isAutoPunished
    ) {
        $this->reportId = $reportId;
        $this->message = $message;
        $this->isPunished = $isPunished;
        $this->isAutoPunished = $isAutoPunished;
    }

    public static function create(
        ReportId $reportId,
        Message $Message,
        IsPunished $IsPunished,
        IsAutoPunished $IsAutoPunished
    ) {
        return new self(
            $reportId,
            $Message,
            $IsPunished,
            $IsAutoPunished
        );
    }

    /***
     * get the value of reportId
     */
    public function getReportId(): ReportId
    {
        return $this->reportId;
    }

    /***
     * get the value of Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /***
     * get the value of isPunished
     */
    public function getIsPunished(): IsPunished
    {
        return $this->isPunished;
    }

    /***
     * get the value of isAutoPunished
     */
    public function getIsAutoPunished(): IsAutoPunished
    {
        return $this->isAutoPunished;
    }

    public function toArray(): array
    {
        return [
            'report_id' => $this->getReportId()->value(),
            'message' => $this->getMessage()->value(),
            'is_punished' => $this->getIsPunished()->value(),
            'is_auto_punished' => $this->getIsAutoPunished()->value()
        ];
    }
}
