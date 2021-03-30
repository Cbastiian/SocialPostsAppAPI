<?php

namespace Src\Api\User\Domain\Contracts;

use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Username;

interface UserValidation
{
    public function throwIfEmailAlreadyExist(Email $email);
    public function throwIfUsernameAlreadyExist(Username $username);
    public function throwIfUserAlreadyActive(Email $email);
}
