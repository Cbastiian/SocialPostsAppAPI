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

    public function toCreateArray(): array
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

    public function toUpdateArray(): array
    {
        return [
            'title' => $this->getTitle()->value(),
            'description' => $this->getDescription()->value(),
            'price' => $this->getPrice()->value(),
            'user_comment' => $this->getUserComment()->value()
        ];
    }

    /***
     * get the value of title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /***
     * set the value of title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /***
     * get the value of description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /***
     * set the value of description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /***
     * get the value of price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /***
     * set the value of price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /***
     * get the value of userComment
     */
    public function getUserComment(): UserComment
    {
        return $this->userComment;
    }

    /***
     * set the value of userComment
     */
    public function setUserComment($userComment)
    {
        $this->userComment = $userComment;
    }

    /***
     * get the value of productCode
     */
    public function getProductCode(): ProductCode
    {
        return $this->productCode;
    }

    /***
     * set the value of productCode
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    /***
     * get the value of image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /***
     * set the value of image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /***
     * get the value of userId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /***
     * set the value of userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
