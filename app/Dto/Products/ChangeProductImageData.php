<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class ChangeProductImageData extends DataTransferObject
{
    public int $productId;
    public UploadedFile $image;
    public int $userId;
}
