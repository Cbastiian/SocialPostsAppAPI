<?php

namespace Src\Api\Shared\Infrastructure;

use Src\Api\Shared\Domain\Contracts\SharedValidations;
use Src\Api\Shared\Domain\Exceptions\OtpValidationFailError;

final class SharedValidationRepository implements SharedValidations
{
    public function throwIfOtpValidationFail(bool $status)
    {
        if (!$status)  throw new OtpValidationFailError();
    }
}
