<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Exception;
use Src\Api\Auth\Application\Authenticater\AuthenticateCommand;
use Src\Api\Auth\Application\AuthUserGetter\GetAuthUserCommand;
use Src\Api\Auth\Application\TokenRefresh\TokenRefreshCommand;
use Src\Api\Auth\Application\Unauthenticater\UnauthenticateCommand;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;

class AuthController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function login(LoginRequest $loginRequest)
    {
        try {
            $data = $loginRequest->data();

            $command = new AuthenticateCommand($data->username, $data->password);

            $auth = $this->commandBus->execute($command);

            return response()->json($auth, 201);
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

    public function logout()
    {
        try {
            $command = new UnauthenticateCommand();

            $this->commandBus->execute($command);

            return response()->json(['message' => 'Successfully logged out']);
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

    public function refresh()
    {
        try {
            $command = new TokenRefreshCommand();

            $token = $this->commandBus->execute($command);

            return response()->json($token, 201);
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

    public function me()
    {
        try {
            $command = new GetAuthUserCommand();

            $user =  $this->commandBus->execute($command);

            return response()->json($user, 200);
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
