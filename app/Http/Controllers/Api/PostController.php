<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\SavePostRequest;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\Post\ChangePostStatusRequest;
use Src\Api\Post\Application\PostGetter\GetPostsCommand;
use Src\Api\Post\Application\PostCreator\CreatePostCommand;
use Src\Api\Post\Application\PostStatusChanger\ChangePostStatusCommand;

class PostController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;;
    }

    public function savePost(SavePostRequest $savePostRequest)
    {
        try {
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

    public function getPosts()
    {
        try {
            $command = new GetPostsCommand();

            $posts = $this->commandBus->execute($command);

            return response()->json($posts, 200);
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

    public function changePostStatus(ChangePostStatusRequest $changePostStatusRequest)
    {
        try {
            $data = $changePostStatusRequest->data();

            $command = new ChangePostStatusCommand(
                $data->postId,
                $data->userId,
                $data->status
            );

            $this->commandBus->execute($command);

            return response([], 204);
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
