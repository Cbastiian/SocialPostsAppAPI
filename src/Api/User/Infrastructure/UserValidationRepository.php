<?php

namespace Src\Api\User\Infrastructure;

use SelfEmailError;
use App\Models\User;
use App\Models\PasswordReset;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Token;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\User\Domain\Exceptions\EmailAlreadyExist;
use Src\Api\User\Domain\Exceptions\UserAlreadyActive;
use Src\Api\User\Domain\Exceptions\UserInactiveError;
use Src\Api\User\Domain\Exceptions\UserNotExistError;
use Src\Api\User\Domain\Exceptions\EmailNotExistError;
use Src\Api\User\Domain\Exceptions\UserIsAdminError;
use Src\Api\User\Domain\Exceptions\UsernameAlreadyExists;
use Src\Api\User\Domain\Exceptions\UsernameNotExistError;

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

    public function throwIfUserAlreadyActive(Email $email)
    {
        $user = $this->findEmail($email)->active;
        if ($user) throw new UserAlreadyActive($email);
    }

    public function throwIfEmailNotExistError(Email $email)
    {
        $user = $this->findEmail($email);

        if ($user === null) throw new EmailNotExistError($email);
    }

    public function throwIfUserNotExist(UserId $userId)
    {
        $user = $this->findUser($userId);

        if ($user === null) throw new UserNotExistError($userId);
    }

    public function thorwIfUserInactive(UserId $userId)
    {
        $user = $this->findUser($userId);

        if (!boolval($user->active)) throw new UserInactiveError($userId);
    }

    public function throwIfUsernameNotExist(Username $username)
    {
        $user = $this->findUsername($username);

        if ($user == null) throw new UsernameNotExistError($username);
    }

    public function throwIfNotSelfEmail(UserId $userId, Email $email)
    {
        $emailFinder = $this->findEmail($email);

        if ($emailFinder) {
            $user = $this->findUser($userId);
            if ($user->email != $emailFinder->email) throw new EmailAlreadyExist($email);
        }
    }

    public function throwIfUserIsAdmin(UserId $userId)
    {
        $user = $this->findUser($userId);

        if($user->hasRole('admin')) throw new UserIsAdminError($userId);
    }

    public function findUser(UserId $userId)
    {
        return User::where('id', $userId->value())->first();
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
