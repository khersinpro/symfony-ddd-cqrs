<?php

namespace App\Blog\Article\Infrastructure\Controller\Api;

use App\Blog\Article\Application\DTO\ArticleDetailsDTO;
use App\Blog\Article\Application\Query\GetPaginatedArticlesDetails\GetPaginatedArticlesDetailsQuery;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\DTO\Pagination\PaginationDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Articles')]
#[Route('/api/articles', name: 'api_articles_get_paginated', methods: ['GET'])]
class GetPaginatedArticlesController extends AbstractController
{
    public function __construct(private QueryBusInterface $queryBusInterface) { }

    public function __invoke(#[MapQueryString] ?PaginationDTO $paginationDTO): JsonResponse
    {
        $query = new GetPaginatedArticlesDetailsQuery(
            $paginationDTO->page ?? 1,
            $paginationDTO->limit ?? 6
        );

        /** @var ArticleDetailsDTO[] $articles */
        $articles = $this->queryBusInterface->execute($query);

        return $this->json($articles, 200);
    }
}