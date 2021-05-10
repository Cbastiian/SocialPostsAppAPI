<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use App\Http\Requests\Api\Like\ToggleLikeRequest;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Likes\Application\LikeToggler\ToggleLikeCommand;

class LikeController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function toggleLike(ToggleLikeRequest $toggleLikeRequest)
    {
        try {
            $data = $toggleLikeRequest->data();

            $command = new ToggleLikeCommand(
                $data->userId,
                $data->postId
            );

            $like = $this->commandBus->execute($command);

            return response()->json($like, 201);
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
