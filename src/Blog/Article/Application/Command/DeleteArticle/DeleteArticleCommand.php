<?php

namespace App\Blog\Article\Application\Command\DeleteArticle;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class DeleteArticleCommand implements CommandInterface
{
    public function __construct(public Uuid $id) { }
}