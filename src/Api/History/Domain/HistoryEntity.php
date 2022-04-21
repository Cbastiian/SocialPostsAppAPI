<?php

declare(strict_types=1);

namespace Src\Api\History\Domain;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\History\Domain\ValueObjects\Comment;
use Src\Api\History\Domain\ValueObjects\HistoryFile;

final class HistoryEntity
{
    private Comment $comment;
    private UserId $userId;
    private HistoryFile $historyFile;

    public function __construct(
        Comment $comment,
        UserId $userId,
        HistoryFile $historyFile
    ) {
        $this->comment = $comment;
        $this->userId = $userId;
        $this->historyFile = $historyFile;
    }

    public static function create(
        Comment $comment,
        UserId $userId,
        HistoryFile $historyFile
    ) {
        return new self(
            $comment,
            $userId,
            $historyFile
        );
    }

    /***
     * get the value of comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }

    /***
     * get the value of userId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /***
     * get the value of historyFile
     */
    public function getHistoryFile(): HistoryFile
    {
        return $this->historyFile;
    }

    public function toArray(): array
    {
        return [
            'comment' => $this->getComment()->value(),
            'user_id' => $this->getUserId()->value(),
            'file' => $this->getHistoryFile()->value()
        ];
    }
}
