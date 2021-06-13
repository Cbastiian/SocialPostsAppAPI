<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\GeneralProductsGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetGeneralProductsCommand implements Command
{
    private int $limit;
    private int $page;

    public function __construct(
        int $limit,
        int $page
    ) {
        $this->limit = $limit;
        $this->page = $page;
    }

    /***
     * get the value of limit
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /***
     * get the value of page
     */
    public function getPage()
    {
        return $this->page;
    }
}
