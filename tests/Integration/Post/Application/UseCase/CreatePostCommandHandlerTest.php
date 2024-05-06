<?php

declare(strict_types=1);

namespace App\Tests\Integration\Post\Application\UseCase;

use App\Post\Application\UseCase\CreatePost\CreatePostCommand;
use App\Post\Application\UseCase\CreatePost\CreatePostCommandHandler;
use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;
use App\Tests\BaseKernelTestCase;

class CreatePostCommandHandlerTest extends BaseKernelTestCase
{
    public function testPostIsCreated(): void
    {
        // Arrange
        $command = new CreatePostCommand(content: 'Some content');

        /** @var CreatePostCommandHandler $handler */
        $handler = self::getContainer()->get(CreatePostCommandHandler::class);

        // Act
        $handler->__invoke($command);

        // Assert
        self::assertNotNull($command->id);

        /** @var PostRepository $repository */
        $repository = self::getContainer()->get(PostRepository::class);
        $post = $repository->findByPostId(new PostId($command->id));
        self::assertNotNull($post);
        self::assertEquals($command->id, $post->getId()->toPrimitive());
    }
}
