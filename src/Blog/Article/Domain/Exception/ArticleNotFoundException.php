<?php

namespace App\Blog\Article\Domain\Exception;

use App\Shared\Domain\Exception\NotFoundException;

class ArticleNotFoundException extends NotFoundException
{
    public function __construct()
    {
        parent::__construct('Article not found', 404);
    }
}