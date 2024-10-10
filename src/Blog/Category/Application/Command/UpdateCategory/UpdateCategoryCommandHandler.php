<?php

namespace App\Blog\Category\Application\Command\UpdateCategory;

use App\Blog\Category\Domain\Service\UpdateCategoryService;
use App\Shared\Application\Command\CommandHandlerInterface;

class UpdateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private UpdateCategoryService $updateCategoryService) { }

    public function __invoke(UpdateCategoryCommand $command): void
    {
        $this->updateCategoryService->update($command->id, $command->name);
    }
}