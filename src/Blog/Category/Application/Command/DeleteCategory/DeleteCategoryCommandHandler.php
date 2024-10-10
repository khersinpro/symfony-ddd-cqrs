<?php

namespace App\Blog\Category\Application\Command\DeleteCategory;

use App\Blog\Category\Domain\Service\DeleteCategoryService;
use App\Shared\Application\Command\CommandHandlerInterface;

class DeleteCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private DeleteCategoryService $deleteCategoryService) { }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        $this->deleteCategoryService->delete($command->id);
    }
}