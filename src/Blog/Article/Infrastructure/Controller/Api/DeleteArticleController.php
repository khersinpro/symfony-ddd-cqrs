<?php

namespace App\Blog\Article\Infrastructure\Controller\Api;

use App\Blog\Article\Application\Command\DeleteArticle\DeleteArticleCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Articles')]
#[Route('/api/article/{id}', name: 'api_articles_delete', methods: ['DELETE'], requirements: ['id' => Requirement::UUID_V4])]
class DeleteArticleController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(string $id): JsonResponse
    {
        $command = new DeleteArticleCommand(new Uuid($id));

        $this->commandBus->execute($command);

        return $this->json(null, 204);
    }
}