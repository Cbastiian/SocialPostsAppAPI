<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostCreator;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class CreatePostCommand implements Command
{
    private string $content;
    private ?UploadedFile $file;
    private int $userId;

    public function __construct(
        string $content,
        ?UploadedFile $file,
        int $userId
    ) {
        $this->content = $content;
        $this->file = $file;
        $this->userId = $userId;
    }

    /***
     * get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /***
     * get the value of file
     */
    public function getFile()
    {
        return $this->file;
    }

    /***
     * get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
