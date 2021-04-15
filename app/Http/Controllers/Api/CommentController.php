<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\Comment\SaveCommentRequest;
use Src\Api\Comment\Application\CommentCreator\CreateCommentCommand;

class CommentController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function saveComment(SaveCommentRequest $saveCommentRequest)
    {
        try {
            $data = $saveCommentRequest->data();

            $command = new CreateCommentCommand(
                $data->content,
                $data->postId,
                $data->commentatorUserId
            );

            $comment = $this->commandBus->execute($command);

            return response()->json($comment, 201);
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
