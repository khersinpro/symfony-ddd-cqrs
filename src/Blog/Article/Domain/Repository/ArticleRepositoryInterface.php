<?php

namespace App\Blog\Article\Domain\Repository;

use App\Shared\Domain\ValueObject\Uuid;
use App\Blog\Article\Domain\Entity\Article;

interface ArticleRepositoryInterface
{
    public function save(Article $article): void;
    public function delete(Article $article): void;
    public function deleteByAuthorId(Uuid $authorId): void;
    public function findById(Uuid $id): ?Article;
    public function findAll(): array;
    public function findArticleDetailsById(Uuid $id): array;
    public function removeDeletedCategoryIds(Uuid $category_id): void;
}