<?php

namespace App\Blog\Article\Application\Query\GetPaginatedArticlesDetails;

use App\Blog\Article\Application\DTO\ArticleDetailsDTO;
use App\Blog\Article\Application\DTO\AuthorDTO;
use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Blog\Category\Application\DTO\CategoryDTO;
use App\Shared\Application\Query\QueryHandlerInterface;

class GetPaginatedArticlesDetailsQueryHandler implements QueryHandlerInterface
{
    public function __construct(private ArticleRepositoryInterface $articleReadRepository) { }

    public function __invoke(GetPaginatedArticlesDetailsQuery $query): array
    {
        $results = $this->articleReadRepository->findAll(
            $query->page, 
            $query->limit
        );

        $articles = [];

        foreach ($results as $article) {
            $articles[] = new ArticleDetailsDTO(
                $article['id'],
                $article['title'],
                $article['content'],
                $article['category_id'],
                new AuthorDTO(
                    $article['author_id'], 
                    $article['author_username']
                ),
                $article['category_name'] ? new CategoryDTO(
                    $article['category_id'],
                    $article['category_name']
                ) : null
            );
        }

        return $articles;
    }
}