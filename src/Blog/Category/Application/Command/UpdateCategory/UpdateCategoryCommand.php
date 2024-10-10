<?php

namespace App\Blog\Category\Application\Command\UpdateCategory;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Domain\ValueObject\Uuid;

class UpdateCategoryCommand implements CommandInterface
{
    public function __construct(
        public Uuid $id,
        public string $name
    ) { }
}