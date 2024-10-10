<?php

namespace App\Blog\Article\Application\Query\GetArticleDetailsById;

use App\Shared\Application\Query\QueryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class GetArticleDetailsByIdQuery implements QueryInterface
{
    public function __construct(public Uuid $id) { }
}