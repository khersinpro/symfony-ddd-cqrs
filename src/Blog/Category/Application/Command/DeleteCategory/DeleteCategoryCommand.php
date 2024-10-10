<?php

namespace App\Blog\Category\Application\Command\DeleteCategory;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class DeleteCategoryCommand implements CommandInterface
{
    public function __construct(public Uuid $id) { }
}