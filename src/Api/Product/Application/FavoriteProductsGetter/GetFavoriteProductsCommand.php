<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\FavoriteProductsGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetFavoriteProductsCommand implements Command
{
    private int $userId;
    private int $limit;
    private int $page;

    public function __construct(
        int $userId,
        int $limit,
        int $page
    ) {
        $this->userId = $userId;
        $this->limit = $limit;
        $this->page = $page;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
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
