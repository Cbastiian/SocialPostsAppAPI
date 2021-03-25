<?php

declare(strict_types=1);

namespace App\Dto\Test;

use Spatie\DataTransferObject\DataTransferObject;

final class TestData extends DataTransferObject
{
    public string $test;
}
