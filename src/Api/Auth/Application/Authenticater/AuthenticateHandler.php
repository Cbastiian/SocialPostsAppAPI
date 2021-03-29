<?php

declare(strict_types=1);

namespace Src\Api\Auth\Application\Authenticater;

use Src\Api\Auth\Domain\Contracts\AuthValidation;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Username;

final class AuthenticateHandler implements CommandHandler
{
    private Authenticater $authenticater;
    private AuthValidation $authValidation;

    public function __construct(
        Authenticater $authenticater,
        AuthValidation $authValidation
    ) {
        $this->authenticater = $authenticater;
        $this->authValidation = $authValidation;
    }

    public function execute($command)
    {
        $username = new Username($command->getUsername());
        $password = new Password($command->getPassword());

        $login = (object) $this->authenticater->__invoke($username, $password);

        $this->authValidation->throwIfInvalidCredentials($login->access_token);

        return $login;
    }
}
