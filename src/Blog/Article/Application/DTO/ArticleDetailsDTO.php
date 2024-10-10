<?php

namespace App\Blog\Article\Application\DTO;

use App\Blog\Category\Application\DTO\CategoryDTO;

readonly class ArticleDetailsDTO extends ArticleDTO
{
    public function __construct(
        string $id,
        string $title,
        string $content,
        string $category_id,
        public AuthorDTO $author,
        public ?CategoryDTO $category
    ) { 
        parent::__construct($id, $title, $content, $category_id);
    }
}