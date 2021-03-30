<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CreateUserRequest;
use App\Http\Requests\Api\User\ResendVerificationEmailRequest;
use App\Http\Requests\Api\User\ValidateUserRequest;
use Exception;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use Src\Api\User\Application\ResendVerificationEmail\ResendVerificationEmailCommand;
use Src\Api\User\Application\UserCreator\CreateUserCommand;
use Src\Api\User\Application\UserEmailValidator\UserEmailValidationCommand;

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

    public function validateUser(ValidateUserRequest $validateUserRequest)
    {
        try {
            $data = $validateUserRequest->data();

            $command = new UserEmailValidationCommand(
                $data->email,
                $data->otpCode
            );

            $this->commandBus->execute($command);

            return response()->json(['message' => 'Authentication success'], 201);
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

    public function resendVerificationEmail(ResendVerificationEmailRequest $resendVerificationEmailRequest)
    {
        try {
            $data = $resendVerificationEmailRequest->data();

            $command = new ResendVerificationEmailCommand($data->email);

            $this->commandBus->execute($command);

            return response()->json(['message' => 'Verification email send succesfully']);
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
