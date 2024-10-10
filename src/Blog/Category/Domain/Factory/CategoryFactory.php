<?php

namespace App\Blog\Category\Domain\Factory;

use App\Blog\Category\Domain\Entity\Category;
use App\Blog\Category\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Domain\UuidGenerator\UuidGeneratorInterface;
use App\Shared\Domain\ValueObject\Uuid;

class CategoryFactory
{
    public function __construct(
        private UuidGeneratorInterface $uuidGenerator,
        private CategoryRepositoryInterface $categoryRepository
    ) { }

    public function create (string $name): void
    {
        $category = new Category(
            new Uuid($this->uuidGenerator->generate()),
            $name
        );

        $this->categoryRepository->save($category);
    }
}