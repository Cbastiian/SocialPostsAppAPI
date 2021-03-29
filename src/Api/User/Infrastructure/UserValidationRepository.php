<?php

namespace Src\Api\User\Infrastructure;

use App\Models\User;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\User\Domain\Exceptions\EmailAlreadyExist;
use Src\Api\User\Domain\Exceptions\UsernameAlreadyExists;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Username;

final class UserValidationRepository implements UserValidation
{
    public function throwIfEmailAlreadyExist(Email $email)
    {
        $user = $this->findEmail($email);
        if ($user) throw new EmailAlreadyExist($email);
    }

    public function throwIfUsernameAlreadyExist(Username $username)
    {
        $user = $this->findUsername($username);
        if ($user) throw new UsernameAlreadyExists($username);
    }

    public function findEmail(Email $email)
    {
        return User::where('email', $email->value())->first();
    }

    public function findUsername(Username $username)
    {
        return User::where('username', $username->value())->first();
    }
}
