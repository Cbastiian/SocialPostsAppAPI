<?php

namespace Src\Api\User\Infrastructure;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Src\Api\User\Domain\Contracts\UserRepository;
use Src\Api\User\Domain\UserEntity;

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
}
