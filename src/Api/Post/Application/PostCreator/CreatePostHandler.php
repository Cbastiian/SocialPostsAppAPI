<?php

declare(strict_types=1);

namespace Src\Api\Post\Application\PostCreator;

use Src\Api\Post\Domain\ValueObjects\Code;
use Src\Api\Post\Domain\ValueObjects\File;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\Post\Domain\ValueObjects\Content;
use Src\Api\Shared\Application\Images\ImageCreator;
use Src\Api\Shared\Domain\Contracts\CommandHandler;
use Src\Api\Shared\Domain\Contracts\SharedRepository;
use Src\Api\Shared\Application\Codes\CodeResourceGenerator;

final class CreatePostHandler implements CommandHandler
{
    private PostCreator $postCreator;
    private ImageCreator $imageCreator;
    private CodeResourceGenerator $codeReosurceGenerator;

    public function __construct(
        PostCreator $postCreator,
        ImageCreator $imageCreator,
        CodeResourceGenerator $codeReosurceGenerator
    ) {
        $this->postCreator = $postCreator;
        $this->imageCreator = $imageCreator;
        $this->codeReosurceGenerator = $codeReosurceGenerator;
    }

    public function execute($command)
    {
        $content = new Content($command->getContent());
        $code = new Code($this->codeReosurceGenerator->__invoke());

        $postFile = $command->getFile() ?
            $this->imageCreator->__invoke($command->getFile(), 'img/post/') :
            (object)['imageName' => ''];

        $file = new File($postFile->imageName);
        $userId = new UserId($command->getUserId());

        return $this->postCreator->__invoke($content, $code, $file, $userId);
    }
}
