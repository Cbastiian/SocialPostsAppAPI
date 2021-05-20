<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductUpdater;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class UpdateProductCommand implements Command
{
    private int $productId;
    private string $title;
    private string $description;
    private string $userComment;
    private string $price;
    public int $userId;

    public function __construct(
        int $productId,
        string $title,
        string $description,
        string $userComment,
        string $price,
        int $userId
    ) {
        $this->productId = $productId;
        $this->title = $title;
        $this->description = $description;
        $this->userComment = $userComment;
        $this->price = $price;
        $this->userId = $userId;
    }

    /***
     * get the value of productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /***
     * get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /***
     * get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /***
     * get the value of userComment
     */
    public function getUserComment()
    {
        return $this->userComment;
    }

    /***
     * get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
