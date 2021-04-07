<?php

namespace Src\Api\User\Infrastructure;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Src\Api\User\Domain\UserEntity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use App\Mail\Api\User\ResetPasswordMailiable;
use Src\Api\Shared\Domain\ValueObjects\Token;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\Contracts\UserRepository;
use App\Mail\Api\User\RegisterVerificationMailiable;
use App\Models\PasswordReset;
use Src\Api\User\Domain\ValueObjects\Bio;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\UserId;

final class UserEloquentRepository implements UserRepository
{
    public function createUser(UserEntity $userEntity)
    {
        return User::create([
            'name' => $userEntity->getName()->value(),
            'email' => $userEntity->getEmail()->value(),
            'username' => $userEntity->getUsername()->value(),
            'password' => Hash::make($userEntity->getPassword()->value()),
            'photo' => $userEntity->getPhoto()->value()
        ]);
    }

    public function generatePasswordReset(Email $email, int $expireTime)
    {
        $token = $this->generateToken();

        $user = $this->findByEmail($email);

        $this->savePasswordReset($email, $token);

        $this->sendResetPasswordMail($user, $email, $token, $expireTime);
    }

    public function changeActiveStatus(Email $email, bool $status)
    {
        User::where('email', $email->value())
            ->update([
                'active' => $status,
                'email_verified_at' => Carbon::now()
            ]);
    }

    public function changePassword(Email $email, Password $password)
    {
        User::where('email', $email->value())
            ->update([
                'password' => Hash::make($password->value())
            ]);
    }

    public function updateBio(UserId $userId, Bio $bio)
    {
        User::where('id', $userId->value())
            ->update([
                'bio' => $bio->value()
            ]);
    }

    public function sendRegisterEmailVerification(Name $name, Email $email, OtpCode $otpCode, int $expireTime)
    {
        Mail::to($email->value())->send(new RegisterVerificationMailiable($name->value(), $otpCode->value(), $expireTime));
    }

    public function sendResetPasswordMail(User $user, Email $email, Token $token, int $expireTime)
    {
        Mail::to($email->value())->send(new ResetPasswordMailiable($user->name, $token->value(), $expireTime));
    }

    public function generateToken()
    {
        $token = new Token(Str::random(60));
        return $token;
    }

    public function savePasswordReset(Email $email, Token $token)
    {
        PasswordReset::where('email', $email->value())->delete();

        PasswordReset::create([
            'email' => $email->value(),
            'token' => $token->value()
        ]);
    }

    public function findByEmail(Email $email)
    {
        return User::where('email', $email->value())->first();
    }
}
