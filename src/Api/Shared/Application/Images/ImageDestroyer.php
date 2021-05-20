<?php

declare(strict_types=1);

namespace Src\Api\Shared\Application\Images;

use Illuminate\Support\Facades\File;

final class ImageDestroyer
{
    public function __invoke(string $path)
    {
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
