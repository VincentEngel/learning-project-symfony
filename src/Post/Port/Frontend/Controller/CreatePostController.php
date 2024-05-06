<?php

declare(strict_types=1);

namespace App\Post\Port\Frontend\Controller;

use App\Post\Application\UseCase\CreatePost\CreatePostCommand;
use App\Shared\Application\Bus\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreatePostController extends AbstractController
{
    #[Route('/posts/create_form', name: 'post.create_form')]
    public function index(): Response
    {
        return $this->render('@post/post_create_form.html.twig');
    }

    #[Route('/posts/create', name: 'post.create')]
    public function create(Request $request, CommandBus $commandBus): Response
    {
        $command = new CreatePostCommand(content: $request->getPayload()->get('content'));
        $commandBus->dispatch($command);
        return $this->redirectToRoute(
            'post.show',
            [
                'id' => $command->id,
            ],
        );
    }
}
