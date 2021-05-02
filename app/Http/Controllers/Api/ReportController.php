<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use App\Http\Requests\Api\Report\CreateReportRequest;
use Src\Api\Reports\Application\ReportCreator\CreateReportCommand;

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
}
