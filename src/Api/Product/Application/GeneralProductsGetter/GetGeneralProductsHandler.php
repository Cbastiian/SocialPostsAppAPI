<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\GeneralProductsGetter;

use Src\Api\Shared\Domain\Contracts\CommandHandler;

final class GetGeneralProductsHandler implements CommandHandler
{
    private GeneralProductsGetter $generalProductsGetter;

    public function __construct(GeneralProductsGetter $generalProductsGetter)
    {
        $this->generalProductsGetter = $generalProductsGetter;
    }

    public function execute($command)
    {
        return $this->generalProductsGetter->__invoke();
    }
}
