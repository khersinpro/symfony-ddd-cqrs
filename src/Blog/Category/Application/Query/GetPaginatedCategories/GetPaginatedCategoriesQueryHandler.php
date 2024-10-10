<?php

namespace App\Blog\Category\Application\Query\GetPaginatedCategories;

use App\Blog\Category\Application\DTO\CategoryDTO;
use App\Blog\Category\Domain\Entity\Category;
use App\Blog\Category\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class GetPaginatedCategoriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) { }

    public function __invoke(GetPaginatedCategoriesQuery $query): array
    {
        /** @var Category[] $results */
        $results = $this->categoryRepository->findAll(
            $query->page,
            $query->limit
        );

        $categoryArray = [];

        foreach ($results as $category) {
            $stringId = $category->getId();
            $test = $stringId->__toString();
            $categoryArray[] = new CategoryDTO(
                $category->getId()->__toString(),
                $category->getName()
            );
        }

        return $categoryArray;
    }
}