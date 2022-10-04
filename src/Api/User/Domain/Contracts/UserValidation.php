<?php

namespace Src\Api\User\Domain\Contracts;

use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\ValueObjects\Username;

interface UserValidation
{
    public function throwIfEmailAlreadyExist(Email $email);
    public function throwIfUsernameAlreadyExist(Username $username);
    public function throwIfUserAlreadyActive(Email $email);
    public function throwIfEmailNotExistError(Email $email);
    public function throwIfUserNotExist(UserId $userId);
    public function thorwIfUserInactive(UserId $userId);
    public function throwIfUsernameNotExist(Username $username);
    public function throwIfNotSelfEmail(UserId $userId, Email $email);
}
