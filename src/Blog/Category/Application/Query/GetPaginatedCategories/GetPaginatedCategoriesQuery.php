<?php

namespace App\Blog\Category\Application\Query\GetPaginatedCategories;

use App\Shared\Application\Query\QueryInterface;

class GetPaginatedCategoriesQuery implements QueryInterface
{
    public function __construct(
        public readonly int $page,
        public readonly int $limit,
    ) { }
}
