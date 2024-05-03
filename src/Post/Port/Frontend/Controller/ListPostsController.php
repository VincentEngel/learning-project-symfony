<?php
declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListPostsController extends AbstractController
{
    #[Route('/posts/list', name: 'post.list_posts')]
    public function homepage(): Response
    {
        return $this->render('@post/list_posts.html.twig');
    }
}