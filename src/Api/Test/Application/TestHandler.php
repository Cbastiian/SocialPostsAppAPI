<?php

declare(strict_types=1);

namespace Src\Api\Test\Application;

use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Test\Domain\Contracts\TestRepository;
use Src\Api\Test\Domain\ValueObjects\Test;

final class TestHandler implements CommandHandler
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function execute($command)
    {
        $test = new Test($command->getTest());
        return $this->testRepository->getTest($test);
    }
}
