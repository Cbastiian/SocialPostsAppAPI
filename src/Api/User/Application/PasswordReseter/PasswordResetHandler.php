<?php

declare(strict_types=1);

namespace Src\Api\User\Application\PasswordReseter;

use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\Shared\Domain\ValueObjects\Token;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Domain\Contracts\SharedValidations;

final class PasswordResetHandler implements CommandHandler
{
    private PasswordReseter $passwordReseter;
    private SharedRepository $sharedRepository;
    private SharedValidations $sharedValidations;

    public function __construct(
        PasswordReseter $passwordReseter,
        SharedRepository $sharedRepository,
        SharedValidations $sharedValidations
    ) {
        $this->passwordReseter = $passwordReseter;
        $this->sharedRepository = $sharedRepository;
        $this->sharedValidations = $sharedValidations;
    }

    public function execute($command)
    {
        $token = new Token($command->getToken());
        $password = new Password($command->getPassword());

        $this->sharedValidations->throwIfTokenIsNotValid($token);

        $passwordReset = $this->sharedRepository->findToken($token);

        $this->sharedValidations->throwIfTokenExpire($passwordReset->created_at);

        $email = new Email($passwordReset->email);

        $this->passwordReseter->__invoke($email, $password);

        $this->sharedRepository->deletePasswordReset($token);
    }
}
