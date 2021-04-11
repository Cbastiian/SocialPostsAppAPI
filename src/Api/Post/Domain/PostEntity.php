<?php

declare(strict_types=1);

namespace Src\Api\Post\Domain;

use Src\Api\Post\Domain\ValueObjects\Code;
use Src\Api\Post\Domain\ValueObjects\File;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\ValueObjects\Content;

final class PostEntity
{
    private Content $content;
    private Code $code;
    private ?File $file;
    private UserId $userId;

    public function __construct(
        Content $content,
        Code $code,
        ?File $file,
        UserId $userId
    ) {
        $this->content = $content;
        $this->code = $code;
        $this->file = $file;
        $this->userId = $userId;
    }

    public static function create(
        Content $content,
        Code $code,
        ?File $file,
        UserId $userId
    ) {
        return  new self(
            $content,
            $code,
            $file,
            $userId
        );
    }

    /***
     * get the value of contnet
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /***
     * get the value of code
     */
    public function getCode(): Code
    {
        return $this->code;
    }

    /***
     * get the value of file
     */
    public function getFile(): File
    {
        return $this->file;
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
            'content' => $this->getContent()->value(),
            'code' => $this->getCode()->value(),
            'file' => $this->getFile()->value(),
            'user_id' => $this->getUserId()->value()
        ];
    }
}
