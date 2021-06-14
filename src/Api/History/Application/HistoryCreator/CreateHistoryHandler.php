<?php

declare(strict_types=1);

namespace Src\Api\History\Application\HistoryCreator;

use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\History\Domain\ValueObjects\Comment;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\History\Domain\ValueObjects\HistoryFile;

final class CreateHistoryHandler implements CommandHandler
{
    private HistoryCreator $historyCreator;
    private ImageCreator $imageCreator;

    public function __construct(
        HistoryCreator $historyCreator,
        ImageCreator $imageCreator
    ) {
        $this->historyCreator = $historyCreator;
        $this->imageCreator = $imageCreator;
    }

    public function execute($command)
    {
        $comment = new Comment($command->getComment());
        $userId = new UserId($command->getUserId());

        $postFile = $command->gethistoryFile() ?
            $this->imageCreator->__invoke($command->gethistoryFile(), 'img/history/') :
            (object)['imageName' => ''];

        $historyFile = new HistoryFile($postFile->imageName);

        return $this->historyCreator->__invoke($comment, $userId, $historyFile);
    }
}
