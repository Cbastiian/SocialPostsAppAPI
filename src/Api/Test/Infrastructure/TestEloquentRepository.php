<?php

namespace Src\Api\Test\Infrastructure;

use Src\Api\Test\Domain\Contracts\TestRepository;
use Src\Api\Test\Domain\ValueObjects\Test;

final class TestEloquentRepository implements TestRepository
{
    public function getTest(Test $test)
    {
        return $test->value();
    }
}
