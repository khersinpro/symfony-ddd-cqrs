<?php

namespace App\Blog\Category\Application\Command\CreateCategory;

use App\Shared\Application\Command\CommandInterface;

class CreateCategoryCommand implements CommandInterface
{
    public function __construct(public string $name) { }
}