<?php

namespace Src\Api\User\Domain\Contracts;

use Src\Api\User\Domain\UserEntity;

interface UserRepository
{
    public function createUser(UserEntity $userEntity);
}
