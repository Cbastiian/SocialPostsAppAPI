<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryCreator;

use Illuminate\Http\UploadedFile;
use Src\Api\Shared\Domain\Contracts\Command;

final class CreateHistoryCommand implements Command
{
    private ?string $comment;
    private int $userId;
    private UploadedFile $historyFile;

    public  function __construct(
        ?string $comment,
        int $userId,
        UploadedFile $historyFile
    ) {
        $this->comment = $comment;
        $this->userId = $userId;
        $this->historyFile = $historyFile;
    }
    /***
     * get the value of comment
     */
    public function getcomment()
    {
        return $this->comment;
    }

    /***
     * get the value of userId
     */
    public function getuserId()
    {
        return $this->userId;
    }

    /***
     * get the value of historyFile
     */
    public function gethistoryFile()
    {
        return $this->historyFile;
    }
}
