<?php

namespace App\Blog\Category\Application\Command\CreateCategory;

use App\Blog\Category\Domain\Entity\Category;
use App\Blog\Category\Domain\Factory\CategoryFactory;
use App\Blog\Category\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\UuidGenerator\UuidGeneratorInterface;
use App\Shared\Domain\ValueObject\Uuid;

class CreateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private CategoryFactory $categoryFactory) { }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $this->categoryFactory->create($command->name);
    }
}