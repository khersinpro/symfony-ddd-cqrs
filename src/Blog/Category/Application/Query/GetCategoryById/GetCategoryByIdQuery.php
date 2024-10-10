<?php

namespace App\Blog\Category\Application\Query\GetCategoryById;

use App\Shared\Application\Query\QueryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class GetCategoryByIdQuery implements QueryInterface
{
    public function __construct(public readonly Uuid $id) { }
}