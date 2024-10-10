<?php

namespace App\Blog\Category\Domain\Exception;

use App\Shared\Domain\Exception\NotFoundException;

class CategoryNotFoundException extends NotFoundException
{
    public function __construct()
    {
        parent::__construct('Category not found', 404);
    }
}