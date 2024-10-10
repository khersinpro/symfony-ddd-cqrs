<?php

namespace App\Blog\Article\Infrastructure\Controller\Api;

use App\Blog\Article\Application\Command\UpdateArticle\UpdateArticleCommand;
use App\Blog\Article\Infrastructure\ValidationDTO\UpdateArticleDTO;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Articles')]
#[Route('/api/article/{id}', name: 'api_articles_update', methods: ['PUT'], requirements: ['id' => Requirement::UUID_V4])]
class UpdateArticleController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(#[MapRequestPayload] UpdateArticleDTO $updateArticleDTO, string $id): JsonResponse
    {
        $command = new UpdateArticleCommand(
            new Uuid($id),
            $updateArticleDTO->title,
            $updateArticleDTO->content,
            new Uuid($updateArticleDTO->category_id)
        );

        $this->commandBus->execute($command);

        return $this->json(null, 204);
    }
}