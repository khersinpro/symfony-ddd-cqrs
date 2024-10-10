<?php

namespace App\Blog\Article\Domain\Entity;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;


class Article extends AggregateRoot
{
    public function __construct(
        private Uuid $id,
        private string $title,
        private string $content,
        private Uuid $author_id,
        private Uuid $category_id
    ) { }   

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAuthorId(): Uuid
    {
        return $this->author_id;
    }

    public function setAuthorId(Uuid $author_id): void
    {
        $this->author_id = $author_id;
    }

    public function setCategoryId(Uuid $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getCategoryId(): Uuid
    {
        return $this->category_id;
    }
}