<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductByTitleFinder;

use Src\Api\Shared\Domain\ValueObjects\Page;
use Src\Api\Shared\Domain\ValueObjects\Limit;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Product\Domain\Constants\ProductConstants;

final class FindProductByTitleHandler implements CommandHandler
{
    private ProductByTitleFinder $productByTitleFinder;

    public function __construct(ProductByTitleFinder $productByTitleFinder)
    {
        $this->productByTitleFinder = $productByTitleFinder;
    }

    public function execute($command)
    {
        $title = new Title($command->getTitle());
        $page = new Page($command->getPage());

        $limit = new Limit($command->getLimit() ?
            $command->getLimit() :
            ProductConstants::PRODUCT_DEFAULT_SEARCH_LIMIT);

        return $this->productByTitleFinder->__invoke($title, $limit, $page);
    }
}
