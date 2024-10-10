<?php

namespace App\Blog\Article\Application\DTO;

readonly class ArticleDTO
{
    public function __construct(
        public string $id,
        public string $title,
        public string $content,
        public string $category_id,
    ) { }
}