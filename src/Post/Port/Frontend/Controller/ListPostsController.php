<?php
declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use App\Post\Application\UseCase\ListPosts\ListPostsQuery;
use App\Shared\Application\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListPostsController extends AbstractController
{
    #[Route('/posts/list', name: 'post.list_posts')]
    public function homepage(QueryBus $queryBus): Response
    {
        $query = new ListPostsQuery();
        $queryResponse = $queryBus->ask($query);

        return $this->render('@post/list_posts.html.twig');
    }
}