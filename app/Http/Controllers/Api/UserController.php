<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use Src\Api\Shared\Domain\Contracts\CommandBus;
use App\Http\Requests\Api\User\CreateUserRequest;
use Src\Api\Shared\Domain\Exceptions\DomainError;
use App\Http\Requests\Api\User\ValidateUserRequest;
use App\Http\Requests\Api\User\ResetPasswordRequest;
use App\Http\Requests\Api\User\UpdateUserBioRequest;
use Src\Api\User\Application\UserCreator\CreateUserCommand;
use App\Http\Requests\Api\User\SendResetPasswordEmailRequest;
use App\Http\Requests\Api\User\UpdateUserProfilePhotoRequest;
use App\Http\Requests\Api\User\ResendVerificationEmailRequest;
use Src\Api\User\Application\UserBioUpdater\UpdateUserBioCommand;
use Src\Api\User\Application\PasswordReseter\PasswordResetCommand;
use Src\Api\User\Application\ProfilePhotoUpdater\UpdateProfilePhotoCommand;
use Src\Api\User\Application\UserEmailValidator\UserEmailValidationCommand;
use Src\Api\User\Application\PasswordResetEmailSender\SendPasswordResetEmailCommand;
use Src\Api\User\Application\ResendVerificationEmail\ResendVerificationEmailCommand;

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

            return response()->json(['message' => 'Verification email send succesfully'], 201);
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

    public function sendResetPasswordMail(SendResetPasswordEmailRequest $sendResetPasswordEmailRequest)
    {
        try {
            $data = $sendResetPasswordEmailRequest->data();

            $command = new SendPasswordResetEmailCommand($data->email);

            $this->commandBus->execute($command);

            return response()->json(['message' => 'Reset password email sent successfully'], 201);
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

    public function resetPassword(ResetPasswordRequest $resetPasswordRequest)
    {
        try {
            $data = $resetPasswordRequest->data();

            $command = new PasswordResetCommand(
                $data->token,
                $data->password
            );

            $this->commandBus->execute($command);

            return response()->json(['message' => 'Password changed succesfully'], 201);
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

    public function updateBio(UpdateUserBioRequest $updateUserBioRequest)
    {
        try {
            $data = $updateUserBioRequest->data();

            $command = new UpdateUserBioCommand(
                $data->userId,
                $data->bio
            );

            $this->commandBus->execute($command);

            return response()->json(['message' => 'Bio updated succesfully'], 204);
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

    public function updatProfilePhoto(UpdateUserProfilePhotoRequest $updateUserProfilePhotoRequest )
    {
        try{
            $data = $updateUserProfilePhotoRequest->data();

            $command = new UpdateProfilePhotoCommand($data->photo);

            $this->commandBus->execute($command);
            return response()->json(['Messaage' => 'User profile photo updated sucessfully'], 204);
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
