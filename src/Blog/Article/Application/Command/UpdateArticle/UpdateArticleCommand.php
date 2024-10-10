<?php

namespace App\Blog\Article\Application\Command\UpdateArticle;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class UpdateArticleCommand implements CommandInterface
{
    public function __construct(
        public Uuid $id,
        public ?string $title = null,
        public ?string $content = null,
        public ?Uuid $category_id = null
    ) { }
}