<?php

declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use App\Post\Application\UseCase\ListPosts\ListPostsQuery;
use App\Post\Application\UseCase\ListPosts\ListPostsQueryResponse;
use App\Post\Application\UseCase\Shared\PostDto;
use App\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListPostsController extends AbstractController
{
    #[Route('/posts/list', name: 'post.list_posts')]
    public function homepage(QueryBusInterface $queryBus): Response
    {
        /** @var ListPostsQueryResponse $response */
        $response = $queryBus->ask(new ListPostsQuery());

        return $this->render(
            '@post/list_posts.html.twig',
            [
                'posts' => array_map(
                    fn (PostDto $post) =>
                        [
                            'id' => $post->id,
                            'content' => $post->content,
                        ],
                    $response->posts
                )
            ]
        );
    }
}
