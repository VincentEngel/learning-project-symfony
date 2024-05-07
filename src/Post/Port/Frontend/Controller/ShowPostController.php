<?php

declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use App\Post\Application\UseCase\GetPost\GetPostQuery;
use App\Post\Application\UseCase\GetPost\GetPostQueryResponse;
use App\Shared\Application\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowPostController extends AbstractController
{
    #[Route('/post/show', name: 'post.show')]
    public function show(Request $request, QueryBus $queryBus): Response
    {
        /** @var GetPostQueryResponse $response */
        $response = $queryBus->ask(new GetPostQuery(id: $request->query->get('id')));
        $post = $response->post;

        return $this->render('@post/post_show.html.twig', [
                'post' => [
                    'id' => $post->id,
                    'content' => $post->content,
                    'parentPostId' => $post->parentPostId,
                ],
            ]);
    }
}
