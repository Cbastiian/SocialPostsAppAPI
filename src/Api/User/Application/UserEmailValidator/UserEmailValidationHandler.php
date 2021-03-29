<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserEmailValidator;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\ValueObjects\Email;

final class UserEmailValidationHandler implements CommandHandler
{
    private UserEmailValidator $userEmailValidation;
    private SharedRepository $sharedRepository;

    public function __construct(
        UserEmailValidator $userEmailValidation,
        SharedRepository $sharedRepository
    ) {
        $this->userEmailValidation = $userEmailValidation;
        $this->sharedRepository = $sharedRepository;
    }

    public function execute($command)
    {
        $email = new Email($command->getEmail());
        $otpCode = new OtpCode($command->getOtpCode());

        $validationStatus = $this->validateCode($email, $otpCode);

        //TODO: excepcion en caso de validacion fallida
        //TODO: activacion de cuenta
        //TODO: cambio en login(solo cuentas activas)
    }

    public function validateCode(Email $email, OtpCode $otpCode): bool
    {
        return $this->sharedRepository->otpCodeValidator($email->value(), $otpCode)->status;
    }
}
