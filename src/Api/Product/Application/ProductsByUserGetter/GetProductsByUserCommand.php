<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductsByUserGetter;

use Src\Api\Shared\Domain\Contracts\Command;

final class GetProductsByUserCommand implements Command
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /***
     * get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }
}
