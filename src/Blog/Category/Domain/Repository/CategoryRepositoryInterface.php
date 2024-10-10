<?php

namespace App\Blog\Category\Domain\Repository;

use App\Blog\Category\Domain\Entity\Category;
use App\Shared\Domain\ValueObject\Uuid;

interface CategoryRepositoryInterface
{
    public function save(Category $category): void;
    public function delete(Category $category): void;
    public function findById(Uuid $id): ?Category;
    public function findAll(int $page, int $limit): array;
}