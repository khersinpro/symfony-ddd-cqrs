<?php

namespace App\Blog\Category\Application\Query\GetCategoryById;

use App\Blog\Category\Application\DTO\CategoryDTO;
use App\Blog\Category\Domain\Entity\Category;
use App\Blog\Category\Domain\Exception\CategoryNotFoundException;
use App\Blog\Category\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class GetCategoryByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository) { }

    public function __invoke(GetCategoryByIdQuery $query): CategoryDTO
    {
        $category = $this->categoryRepository->findById($query->id);

        if ($category === null) {
            throw new CategoryNotFoundException();
        }

        return new CategoryDTO(
            $category->getId()->__toString(),
            $category->getName()
        );
    }
}