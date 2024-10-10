<?php

namespace App\Blog\Article\Infrastructure\Controller\Api;

use App\Blog\Article\Application\Command\CreateArticle\CreateArticleCommand;
use App\Blog\Article\Application\DTO\ArticleDTO;
use App\Blog\Article\Infrastructure\ValidationDTO\CreateArticleInputDTO;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Articles')]
#[Route('/api/articles', name: 'api_articles_create', methods: ['POST'])]
class CreateArticleController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(#[MapRequestPayload] CreateArticleInputDTO $dto): JsonResponse
    {
        $command = new CreateArticleCommand(
            $dto->title,
            $dto->content,
            new Uuid($dto->category_id)
        );

        /** @var ArticleDTO $article */
        $article = $this->commandBus->execute($command); 

        return $this->json($article, 201);
    }
}