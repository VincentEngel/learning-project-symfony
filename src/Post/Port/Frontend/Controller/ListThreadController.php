<?php

declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use App\Post\Application\UseCase\ListThread\ListThreadQuery;
use App\Post\Application\UseCase\ListThread\ListThreadQueryResponse;
use App\Post\Application\UseCase\Shared\PostDto;
use App\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListThreadController extends AbstractController
{
    #[Route('/thread/show', name: 'thread.show')]
    public function show(Request $request, QueryBusInterface $queryBus): Response
    {
        /** @var ListThreadQueryResponse $response */
        $response = $queryBus->ask(new ListThreadQuery(postId: $request->query->get('id')));

        return $this->render(
            '@post/thread_show.html.twig',
            [
                'posts' => array_map(
                    fn (PostDto $post) => [
                        'id' => $post->id,
                        'content' => $post->content,
                        'parentPostId' => $post->parentPostId,
                    ],
                    $response->posts
                ),
            ]
        );
    }
}
