<?php

declare(strict_types=1);

namespace App\Tests\Integration\Post\Application\UseCase;

use App\Post\Application\UseCase\CreatePost\CreatePostCommand;
use App\Post\Application\UseCase\CreatePost\CreatePostCommandHandlerInterface;
use App\Post\Domain\Entity\PostId;
use App\Post\Domain\Repository\PostRepository;
use App\Tests\BaseKernelTestCase;

class CreatePostCommandHandlerTest extends BaseKernelTestCase
{
    public function testPostIsCreated(): void
    {
        // Arrange
        $command = new CreatePostCommand(content: 'Some content');

        /** @var CreatePostCommandHandlerInterface $handler */
        $handler = self::getContainer()->get(CreatePostCommandHandlerInterface::class);

        // Act
        $handler->__invoke($command);

        // Assert
        self::assertNotNull($command->generatedEntityId);

        /** @var PostRepository $repository */
        $repository = self::getContainer()->get(PostRepository::class);

        $post = $repository->findByPostId(new PostId($command->generatedEntityId));

        self::assertNotNull($post);
        self::assertEquals($command->generatedEntityId, $post->getId()->toPrimitive());
        self::assertEmpty($post->getParentPostId());
    }
}
