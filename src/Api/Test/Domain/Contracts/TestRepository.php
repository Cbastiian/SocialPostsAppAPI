<?php

namespace Src\Api\Test\Domain\Contracts;

use Src\Api\Test\Domain\ValueObjects\Test;

interface TestRepository
{
    public function getTest(Test $test);
}
