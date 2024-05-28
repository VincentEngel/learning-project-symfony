<?php

declare(strict_types=1);

namespace App\Post\Port\Api\Controller;

use App\Post\Application\UseCase\GetPost\GetPostQuery;
use App\Post\Application\UseCase\GetPost\GetPostQueryResponse;
use App\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetPostController extends AbstractController
{
    #[Route('/api/post/{postId}', name: 'api.post.get', methods: ['GET'])]
    public function getPost(QueryBusInterface $queryBus, string $postId): Response
    {
        /** @var GetPostQueryResponse $response */
        $response = $queryBus->ask(new GetPostQuery(id: $postId));

        return $this->json([
            'id' => $response->post->id,
            'content' => $response->post->content,
            'parent_post_id' => $response->post->parentPostId,
        ]);
    }
}
