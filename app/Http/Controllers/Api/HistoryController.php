<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\History\SaveHistoryRequest;
use App\Http\Requests\Api\History\ChangeHistoryStatusRequest;
use Src\Api\History\Application\HistoryCreator\CreateHistoryCommand;
use Src\Api\History\Application\HistoryStatusChanger\ChangeHistoryStatusCommand;

class HistoryController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function saveHistory(SaveHistoryRequest $saveHistoryRequest)
    {
        try {
            $data = $saveHistoryRequest->data();

            $command = new CreateHistoryCommand(
                $data->comment,
                $data->userId,
                $data->file
            );

            $history = $this->commandBus->execute($command);

            return response()->json($history, 201);
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

    public function changeHistoryStatus(ChangeHistoryStatusRequest $changeHistoryStatusRequest)
    {
        try {
            $data = $changeHistoryStatusRequest->data();

            $command = new ChangeHistoryStatusCommand(
                $data->historyId,
                $data->userId,
                $data->status
            );

            $this->commandBus->execute($command);

            return response()->json([], 204);
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
