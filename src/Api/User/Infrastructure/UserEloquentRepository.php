<?php

namespace Src\Api\User\Infrastructure;

use App\Mail\Api\User\RegisterVerificationMailiable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\UserEntity;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Name;

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

    public function changeActiveStatus(Email $email, bool $status)
    {
        User::where('email', $email->value())
            ->update([
                'active' => $status
            ]);
    }

    public function sendRegisterEmailVerification(Name $name, Email $email, OtpCode $otpCode, int $expireTime)
    {
        Mail::to($email->value())->send(new RegisterVerificationMailiable($name->value(), $otpCode->value(), $expireTime));
    }

    public function findByEmail(Email $email)
    {
        return User::where('email', $email->value())->first();
    }
}
