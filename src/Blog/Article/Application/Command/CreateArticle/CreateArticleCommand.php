<?php

namespace App\Blog\Article\Application\Command\CreateArticle;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class CreateArticleCommand implements CommandInterface
{
    public function __construct(
        public string $title,
        public string $content,
        public Uuid $category_id
    ) { }
}