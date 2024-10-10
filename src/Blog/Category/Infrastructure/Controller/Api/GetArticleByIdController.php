<?php

namespace App\Blog\Category\Infrastructure\Controller\Api;

use App\Blog\Category\Application\DTO\CategoryDTO;
use App\Blog\Category\Application\Query\GetCategoryById\GetCategoryByIdQuery;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Categories')]
#[Route('/api/categories/{id}', name: 'api_get_category_by_id', methods: ['GET'], requirements: ['id' => Requirement::UUID_V4])]
class GetArticleByIdController extends AbstractController
{
    public function __construct(private QueryBusInterface $queryBus) { }

    public function __invoke(string $id): JsonResponse
    {
        $query = new GetCategoryByIdQuery(new Uuid($id));

        /** @var CategoryDTO $article */
        $article = $this->queryBus->execute($query);

        return $this->json($article, 200);
    }
}