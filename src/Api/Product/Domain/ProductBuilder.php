<?php

namespace Src\Api\Product\Domain;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Product\Domain\ValueObjects\Title;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\ValueObjects\UserComment;
use Src\Api\Product\Domain\Contracts\ProductBuilderInterface;

final class ProductBuilder implements ProductBuilderInterface
{
    private ProductEntity $productEntity;

    private Title $title;
    private Description $description;
    private Price $price;
    private UserComment $userComment;
    private ProductCode $productCode;
    private Image $image;
    private UserId $userId;

    public function __construct()
    {
        $this->productEntity = new ProductEntity();
    }

    public function buildCreateProduct(): ProductEntity
    {
        $this->productEntity->setTitle($this->title);
        $this->productEntity->setDescription($this->description);
        $this->productEntity->setPrice($this->price);
        $this->productEntity->setUserComment($this->userComment);
        $this->productEntity->setProductCode($this->productCode);
        $this->productEntity->setImage($this->image);
        $this->productEntity->setUserId($this->userId);

        return $this->productEntity;
    }

    public function buildBasicUpdateProduct(): ProductEntity
    {
        $this->productEntity->setTitle($this->title);
        $this->productEntity->setDescription($this->description);
        $this->productEntity->setPrice($this->price);
        $this->productEntity->setUserComment($this->userComment);

        return $this->productEntity;
    }

    /***
     * with the value of title
     */
    public function withTitle(Title $title)
    {
        $this->title = $title;

        return $this;
    }

    /***
     * with the value of descrip
     */
    public function withDescription(Description $description)
    {
        $this->description = $description;

        return $this;
    }

    /***
     * with the value of price
     */
    public function withPrice(Price $price)
    {
        $this->price = $price;

        return $this;
    }

    /***
     * with the value of userCom
     */
    public function withUserComment(UserComment $userComment)
    {
        $this->userComment = $userComment;

        return $this;
    }

    /***
     * with the value of product
     */
    public function withProductCode(ProductCode $productCode)
    {
        $this->productCode = $productCode;

        return $this;
    }

    /***
     * with the value of image
     */
    public function withImage(Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /***
     * with the value of userId
     */
    public function withUserId(UserId $userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
