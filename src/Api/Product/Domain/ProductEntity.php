<?php

declare(strict_types=1);

namespace Src\Api\Product\Domain;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\ValueObjects\UserComment;

final class ProductEntity
{
    private Title $title;
    private Description $description;
    private Price $price;
    private UserComment $userComment;
    private ProductCode $productCode;
    private Image $image;
    private UserId $userId;

    public function __construct(
        Title $title,
        Description $description,
        Price $price,
        UserComment $userComment,
        ProductCode $productCode,
        Image $image,
        UserId $userId
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->userComment = $userComment;
        $this->productCode = $productCode;
        $this->image = $image;
        $this->userId = $userId;
    }

    public static function create(
        Title $title,
        Description $description,
        Price $price,
        UserComment $userComment,
        ProductCode $productCode,
        Image $image,
        UserId $userId
    ) {
        return new self(
            $title,
            $description,
            $price,
            $userComment,
            $productCode,
            $image,
            $userId
        );
    }

    /***
     * get the value of title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /***
     * get the value of description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /***
     * get the value of price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /***
     * get the value of userComment
     */
    public function getUserComment(): UserComment
    {
        return $this->userComment;
    }

    /***
     * get the value of productCode
     */
    public function getProductCode(): ProductCode
    {
        return $this->productCode;
    }

    /***
     * get the value of image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /***
     * get the value of userId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle()->value(),
            'description' => $this->getDescription()->value(),
            'price' => $this->getPrice()->value(),
            'user_comment' => $this->getUserComment()->value(),
            'image' => $this->getImage()->value(),
            'product_code' => $this->getProductCode()->value(),
            'user_id' => $this->getUserId()->value()
        ];
    }
}
