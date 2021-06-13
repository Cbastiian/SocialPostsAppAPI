<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductByTitleFinder;

use Src\Api\Shared\Domain\Contracts\Command;

final class FindProductByTitleCommand implements Command
{
    private string $title;
    private ?int $limit;
    private int $page;

    public function __construct(
        string $title,
        ?int $limit,
        int $page
    ) {
        $this->title = $title;
        $this->limit = $limit;
        $this->page = $page;
    }

    /***
     * get the value of title
     */
    public function getTitle()
    {
        return $this->title;
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
