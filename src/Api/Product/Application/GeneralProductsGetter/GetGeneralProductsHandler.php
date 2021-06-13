<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\GeneralProductsGetter;

use Src\Api\Shared\Domain\ValueObjects\Page;
use Src\Api\Shared\Domain\ValueObjects\Limit;
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
        $limit = new Limit($command->getLimit());
        $page = new Page($command->getPage());

        return $this->generalProductsGetter->__invoke(
            $limit,
            $page
        );
    }
}
