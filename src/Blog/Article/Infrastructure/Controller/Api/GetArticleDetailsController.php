<?php

namespace App\Blog\Article\Infrastructure\Controller\Api;

use App\Blog\Article\Application\Query\GetArticleDetailsById\GetArticleDetailsByIdQuery;
use App\Shared\Application\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Blog\Article\Application\DTO\ArticleDetailsDTO;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Articles')]
#[Route('/api/articles/{id}', name: 'api_articles_get', methods: ['GET'])]
class GetArticleDetailsController extends AbstractController
{
    public function __construct(private QueryBusInterface $queryBus) { }

    public function __invoke(string $id): JsonResponse
    {
        $uuid = new \App\Shared\Domain\ValueObject\Uuid($id);
        $query = new GetArticleDetailsByIdQuery($uuid);

        /** @var ArticleDetailsDTO $articleDetails */
        $articleDetails = $this->queryBus->execute($query);
        
        return $this->json($articleDetails, 200);
    }
}