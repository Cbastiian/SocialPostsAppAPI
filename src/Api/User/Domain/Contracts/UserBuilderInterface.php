<?php

namespace Src\Api\User\Domain\Contracts;

use Src\Api\User\Domain\UserEntity;

interface UserBuilderInterface
{
    public function buildCreateUser(): UserEntity;
    public function buildUpdateUser(): UserEntity;
}
