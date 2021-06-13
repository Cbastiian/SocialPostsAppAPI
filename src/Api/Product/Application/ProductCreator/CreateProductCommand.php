<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductCreator;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class CreateProductCommand implements Command
{
    public string $title;
    public string $price;
    public ?string $description;
    public ?string $userComment;
    public ?UploadedFile $image;
    public int $userId;

    public function __construct(
        string $title,
        string $price,
        ?string $description,
        ?string $userComment,
        ?UploadedFile $image,
        int $userId
    ) {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->userComment = $userComment;
        $this->image = $image;
        $this->userId = $userId;
    }

    /***
     * get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /***
     * get the value of price
     */
    public function getPrice()
    {
        return $this->price;
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
     * get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
