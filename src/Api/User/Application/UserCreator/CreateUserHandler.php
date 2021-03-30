<?php

declare(strict_types=1);

namespace Src\Api\User\Application\UserCreator;

use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\User\Domain\ValueObjects\Username;
use Src\Api\User\Domain\Contracts\UserValidation;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;

final class CreateUserHandler implements CommandHandler
{
    private UserCreator $userCreator;
    private ImageCreator $imageCreator;
    private EmailVerificationSend $emailVerificationSend;
    private SharedRepository $sharedRepository;
    private UserValidation $userValidation;

    public function __construct(
        UserCreator $userCreator,
        ImageCreator $imageCreator,
        SharedRepository $sharedRepository,
        EmailVerificationSend $emailVerificationSend,
        UserValidation $userValidation
    ) {
        $this->userCreator = $userCreator;
        $this->imageCreator = $imageCreator;
        $this->emailVerificationSend = $emailVerificationSend;
        $this->sharedRepository = $sharedRepository;
        $this->userValidation = $userValidation;
    }

    public function execute($command)
    {
        $name = new Name($command->getName());
        $email = new Email($command->getEmail());
        $username = new Username($command->getUsername());
        $password = new Password($command->getPassword());

        $this->userValidation->throwIfEmailAlreadyExist($email);
        $this->userValidation->throwIfUsernameAlreadyExist($username);

        $userPhoto = $this->imageCreator->__invoke($command->getPhoto(), 'img/profile/');

        $photo = new Photo($userPhoto->imageName);

        $user = $this->userCreator->__invoke(
            $name,
            $email,
            $username,
            $password,
            $photo
        );

        $expireTime = intval(env("USER_VALIDATION_OTP_EXPIRE", 20));

        $otpCode = new OtpCode($this->sharedRepository->getOtpCode(
            $email->value(),
            $expireTime
        )->token);

        $this->emailVerificationSend->__invoke($name, $email, $otpCode, $expireTime);

        return $user;
    }
}
