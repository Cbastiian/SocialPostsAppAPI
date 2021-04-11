<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\SavePostRequest;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\Post\Application\PostCreator\CreatePostCommand;

class PostController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;;
    }

    public function savePost(SavePostRequest $savePostRequest)
    {
        try{
            $data = $savePostRequest->data();

            $command = new CreatePostCommand(
                $data->content,
                $data->file,
                $data->userId
            );

            $post = $this->commandBus->execute($command);

            return response()->json($post, 201);
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
