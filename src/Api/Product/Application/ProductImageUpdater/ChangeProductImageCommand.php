<?php

declare(strict_types=1);

namespace Src\Api\Product\Application\ProductImageUpdater;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class ChangeProductImageCommand implements Command
{
    private int $productId;
    private UploadedFile $image;
    private int $userId;

    public function __construct(
        int $productId,
        UploadedFile $image,
        int $userId
    ) {
        $this->productId = $productId;
        $this->image = $image;
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
