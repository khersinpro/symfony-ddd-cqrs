<?php

namespace App\Blog\Category\Infrastructure\Controller\Api;

use App\Blog\Category\Application\DTO\CategoryDTO;
use App\Blog\Category\Application\Query\GetPaginatedCategories\GetPaginatedCategoriesQuery;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\DTO\Pagination\PaginationDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Categories')]
#[Route('/api/categories', name: 'api_get_paginated_categories', methods: ['GET'])]
class GetPaginatedArticlesController extends AbstractController
{
    public function __construct(private QueryBusInterface $queryBus) { }

    public function __invoke(#[MapQueryString] ?PaginationDTO $paginationDTO): JsonResponse
    {
        $query = new GetPaginatedCategoriesQuery(
            $paginationDTO->page ?? 1,
            $paginationDTO->limit ?? 10
        );

        /** @var CategoryDTO[] $articlesArray */
        $articlesArray = $this->queryBus->execute($query);

        return $this->json($articlesArray, 200);
    }
}