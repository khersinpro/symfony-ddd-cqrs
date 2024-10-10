<?php

namespace App\Blog\Article\Application\Query\GetArticleDetailsById;

use App\Blog\Article\Application\DTO\ArticleDetailsDTO;
use App\Blog\Article\Application\DTO\AuthorDTO;
use App\Blog\Article\Domain\Exception\ArticleNotFoundException;
use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class GetArticleDetailsByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private ArticleRepositoryInterface $articleReadRepository) { }

    public function __invoke(GetArticleDetailsByIdQuery $query)
    {
        $results = $this->articleReadRepository->findArticleDetailsById($query->id);

        if (empty($results)) {
            throw new ArticleNotFoundException();
        }

        $articleDetails = $results[0];

        return new ArticleDetailsDTO(
            $articleDetails['id'],
            $articleDetails['title'],
            $articleDetails['content'],
            $articleDetails['category_id'],
            new AuthorDTO(
                $articleDetails['author_id'], 
                $articleDetails['author_username']
            ),
            null
        );
    }
}