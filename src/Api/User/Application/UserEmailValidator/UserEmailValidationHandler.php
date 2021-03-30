<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserEmailValidator;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Domain\Contracts\SharedValidations;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\ValueObjects\Email;

final class UserEmailValidationHandler implements CommandHandler
{
    private UserEmailValidator $userEmailValidator;
    private SharedRepository $sharedRepository;
    private SharedValidations $shraredValidations;

    public function __construct(
        UserEmailValidator $userEmailValidator,
        SharedRepository $sharedRepository,
        SharedValidations $shraredValidations
    ) {
        $this->userEmailValidator = $userEmailValidator;
        $this->sharedRepository = $sharedRepository;
        $this->shraredValidations = $shraredValidations;
    }

    public function execute($command)
    {
        $email = new Email($command->getEmail());
        $otpCode = new OtpCode($command->getOtpCode());

        $validationStatus = $this->validateCode($email, $otpCode);

        $this->shraredValidations->throwIfOtpValidationFail($validationStatus);

        $this->userEmailValidator->__invoke($email, $validationStatus);
    }

    public function validateCode(Email $email, OtpCode $otpCode): bool
    {
        return $this->sharedRepository->otpCodeValidator($email->value(), $otpCode)->status;
    }
}
