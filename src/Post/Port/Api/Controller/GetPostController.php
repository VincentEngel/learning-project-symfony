<?php

declare(strict_types=1);

namespace App\Post\Port\Api\Controller;

use App\Post\Application\UseCase\GetPost\GetPostQuery;
use App\Post\Application\UseCase\GetPost\GetPostQueryResponse;
use App\Shared\Application\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetPostController extends AbstractController
{
    #[Route('/api/post/get', name: 'api.post.get', methods: ['GET'])]
    public function getPost(QueryBus $queryBus): Response
    {
        /** @var GetPostQueryResponse $response */
        $response = $queryBus->ask(new GetPostQuery(id: 'some_uuid'));

        return $this->json([
            'id' => $response->id,
            'content' => $response->content,
        ]);
    }
}
