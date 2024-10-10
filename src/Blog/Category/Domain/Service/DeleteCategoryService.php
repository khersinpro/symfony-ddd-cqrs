<?php

namespace App\Blog\Category\Domain\Service;

use App\Blog\Category\Domain\Exception\CategoryNotFoundException;
use App\Blog\Category\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Domain\Event\DomainEventBusInterface;
use App\Shared\Domain\Exception\ForbidenException;
use App\Shared\Domain\Security\CurrentUserProviderInterface;
use App\Shared\Domain\ValueObject\Uuid;

class DeleteCategoryService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private CurrentUserProviderInterface $currentUserProvider,
        private DomainEventBusInterface $domainEventBus
    ) { }

    public function delete(Uuid $id): void
    {
        $currentUser = $this->currentUserProvider->getRequiredCurrentUser();
        
        if (in_array('ROLE_ADMIN', $currentUser->getRoles()) === false) {
            throw new ForbidenException();
        }
        
        $category = $this->categoryRepository->findById($id);

        if ($category === null) {
            throw new CategoryNotFoundException();
        }

        $this->categoryRepository->delete($category);

        $events = $category->releaseEvents();

        $this->domainEventBus->dispatch(...$events);
    }
}