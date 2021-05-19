<?php

declare(strict_types=1);

namespace Src\Api\Product\Domain;

use Src\Api\Shared\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Shared\Domain\ValueObjects\Image;
use Src\Api\Product\Domain\ValueObjects\Price;
use Src\Api\Shared\Domain\ValueObjects\Description;
use Src\Api\Product\Domain\ValueObjects\ProductCode;
use Src\Api\Product\Domain\ValueObjects\UserComment;

final class ProductEntity
{
    private Name $name;
    private Description $description;
    private Price $price;
    private UserComment $userComment;
    private ProductCode $productCode;
    private Image $image;
    private UserId $userId;

    public function __construct(
        Name $name,
        Description $description,
        Price $price,
        UserComment $userComment,
        ProductCode $productCode,
        Image $image,
        UserId $userId
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->userComment = $userComment;
        $this->productCode = $productCode;
        $this->image = $image;
        $this->userId = $userId;
    }

    public static function create(
        Name $name,
        Description $description,
        Price $price,
        UserComment $userComment,
        ProductCode $productCode,
        Image $image,
        UserId $userId
    ) {
        return new self(
            $name,
            $description,
            $price,
            $userComment,
            $productCode,
            $image,
            $userId
        );
    }

    /***
     * get the value of name
     */
    public function getName(): Name
    {
        return $this->name;
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
            'name' => $this->getName()->value(),
            'description' => $this->getDescription()->value(),
            'price' => $this->getPrice()->value(),
            'user_comment' => $this->getUserComment()->value(),
            'imge' => $this->getImage()->value(),
            'code' => $this->getProductCode()->value(),
            'user_id' => $this->getUserId()->value()
        ];
    }
}
