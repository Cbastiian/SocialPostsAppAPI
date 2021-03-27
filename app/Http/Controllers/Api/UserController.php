<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use Exception;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Application\UserCreator\CreateUserCommand;

class UserController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function createUser(CreateUserRequest $createUserRequest)
    {
        try {
            $data = $createUserRequest->data();

            $command = new CreateUserCommand(
                $data->name,
                $data->email,
                $data->username,
                $data->password,
                $data->photo
            );

            $user = $this->commandBus->execute($command);

            return response()->json($user, 201);
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
