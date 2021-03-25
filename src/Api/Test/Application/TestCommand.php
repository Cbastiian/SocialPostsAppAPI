<?php

declare(strict_types=1);

namespace Src\Api\Test\Application;

use Src\Api\Shared\Domain\Contracts\Command;

final class TestCommand implements Command
{
    private string $test;

    public function __construct(string $test)
    {
        $this->test = $test;
    }

    /***
     * get the value of test
     */
    public function getTest()
    {
        return $this->test;
    }
}
