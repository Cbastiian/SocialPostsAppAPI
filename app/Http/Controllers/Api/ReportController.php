<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\Report\GetReportsRequest;
use App\Http\Requests\Api\Report\CreateReportRequest;
use App\Http\Requests\Api\Report\PunishReportRequest;
use Src\Api\Reports\Application\ReportGetter\GetReportsCommand;
use Src\Api\Reports\Application\ReportCreator\CreateReportCommand;
use Src\Api\Reports\Application\ReportPunisher\PunishReportCommand;

class ReportController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;;
    }

    public function saveReport(CreateReportRequest $createReportRequest)
    {
        try {
            $data = $createReportRequest->data();

            $command = new CreateReportCommand(
                $data->reasonId,
                $data->reportElementType,
                $data->reportElementId,
                $data->reportUserId
            );

            $report = $this->commandBus->execute($command);

            return response()->json($report, 201);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function getReports(GetReportsRequest $getReportsRequest)
    {
        try {
            $data = $getReportsRequest->data();

            $command = new GetReportsCommand($data->reportElementType);

            $reports = $this->commandBus->execute($command);

            return response()->json($reports, 200);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }

    public function punishReport(PunishReportRequest $punishReportRequest)
    {
        try {
            $data = $punishReportRequest->data();

            $command = new PunishReportCommand(
                $data->reportId,
                $data->message,
                $data->isPunished
            );

            $punish = $this->commandBus->execute($command);

            return response()->json($punish, 200);
        } catch (DomainError $error) {
            return response()->json([
                "code" => $error->errorCode(),
                "detail" => $error->errorMessage()
            ], 422);
        } catch (Exception $th) {
            return response()->json([
                'code' => $th->getCode(),
                'detail' => $th->getMessage()
            ], 500);
        }
    }
}
