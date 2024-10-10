<?php

namespace App\Blog\Article\Application\Query\GetPaginatedArticlesDetails;

use App\Shared\Application\Query\QueryInterface;

class GetPaginatedArticlesDetailsQuery implements QueryInterface
{
    public function __construct(
        public readonly int $page,
        public readonly int $limit,
    ) { }
}