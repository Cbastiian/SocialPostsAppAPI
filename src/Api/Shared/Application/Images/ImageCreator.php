<?php

declare(strict_types=1);

namespace Src\Api\Shared\Application\Images;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

final class ImageCreator
{
    public function __invoke(
        UploadedFile $file,
        string $path
    ) {
        $fileName = Str::random(32);

        $fileExtesion = $file->getClientOriginalExtension();

        $finalFileName = $fileName . '.' . $fileExtesion;

        $fullFilePath = $path . $finalFileName;

        $this->checkIfRouteExist($path);

        Image::make($file)->save($fullFilePath);

        return (object)[
            'imageName' => $fullFilePath
        ];
    }

    public function checkIfRouteExist(string $path)
    {
        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }
    }
}
