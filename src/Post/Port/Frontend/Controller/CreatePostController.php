<?php

declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use App\Post\Application\UseCase\CreatePost\CreatePostCommand;
use App\Post\Application\UseCase\ListPosts\ListPostsQuery;
use App\Post\Application\UseCase\ListPosts\ListPostsQueryResponse;
use App\Post\Application\UseCase\Shared\PostDto;
use App\Shared\Application\Bus\Command\CommandBusInterface;
use App\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreatePostController extends AbstractController
{
    #[Route('/posts/create_form', name: 'post.create_form')]
    public function index(QueryBusInterface $queryBus): Response
    {
        /** @var ListPostsQueryResponse $response */
        $response = $queryBus->ask(new ListPostsQuery());

        return $this->render(
            '@post/post_create_form.html.twig',
            [
                'posts' => array_map(
                    fn (PostDto $post) => [
                        'id' => $post->id,
                        'content' => $post->content,
                    ],
                    $response->posts
                ),
            ]
        );
    }

    #[Route('/posts/create', name: 'post.create')]
    public function create(Request $request, CommandBusInterface $commandBus): Response
    {
        $command = new CreatePostCommand(
            content: $request->getPayload()->get('content'),
            parentPostId: '' !== $request->getPayload()->get('parent_post_id')
                ? $request->getPayload()->get('parent_post_id') : null
        );

        $commandBus->dispatch($command);

        return $this->redirectToRoute(
            'post.show',
            [
                'id' => $command->generatedEntityId,
            ],
        );
    }
}
