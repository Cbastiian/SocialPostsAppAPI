<?php

namespace Src\Api\Shared\Domain\Contracts;

interface SharedValidations
{
    public function throwIfOtpValidationFail(bool $status);
}
