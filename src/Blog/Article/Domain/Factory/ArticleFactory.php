<?php

namespace App\Blog\Article\Domain\Factory;

use App\Blog\Article\Domain\Entity\Article;
use App\Shared\Domain\UuidGenerator\UuidGeneratorInterface;
use App\Shared\Domain\ValueObject\Uuid;

class ArticleFactory
{
    public function __construct(private UuidGeneratorInterface $uuidGenerator) { }

    public function create(string $title, string $content, Uuid $author_id, Uuid $category_id): Article
    {
        return new Article(
            new Uuid($this->uuidGenerator->generate()),
            $title, 
            $content, 
            $author_id,
            $category_id
        );
    }
}