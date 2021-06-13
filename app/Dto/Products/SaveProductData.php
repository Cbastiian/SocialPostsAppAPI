<?php

declare(strict_types=1);

namespace App\Dto\Products;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

final class SaveProductData extends DataTransferObject
{
    public string $title;
    public string $price;
    public ?string $description;
    public ?string $userComment;
    public ?UploadedFile $image;
    public int $userId;
}
