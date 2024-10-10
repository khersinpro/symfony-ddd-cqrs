<?php

namespace App\Blog\Article\Domain\Service;

use App\Blog\Article\Domain\Exception\ArticleNotFoundException;
use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class UpdateArticleService
{
    public function __construct(private ArticleRepositoryInterface $articleRepository) { }

    public function update(Uuid $id, ?string $title, ?string $content, ?Uuid $category_id): void
    {
        $article = $this->articleRepository->findById($id);

        if ($article === null) {
            throw new ArticleNotFoundException(); 
        }

        $article->setTitle($title ?? $article->getTitle());
        $article->setContent($content ?? $article->getContent());
        $article->setCategoryId($category_id ?? $article->getCategoryId());

        $this->articleRepository->save($article);
    }
}