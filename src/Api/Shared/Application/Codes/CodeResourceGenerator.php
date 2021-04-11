<?php

declare(strict_types=1);

namespace Src\Api\Shared\Application\Codes;

use Src\Api\Shared\Domain\Contracts\SharedRepository;

final class CodeResourceGenerator
{
    public SharedRepository $sharedRepository;

    public function __construct(
        SharedRepository $sharedRepository
    )
    {
        $this->sharedRepository = $sharedRepository;
    }

    public function __invoke()
    {
        return $this->sharedRepository->resourceCodeGenerator();
    }
}
