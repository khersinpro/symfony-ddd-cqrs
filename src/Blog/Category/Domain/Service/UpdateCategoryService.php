<?php

namespace App\Blog\Category\Domain\Service;

use App\Blog\Category\Domain\Exception\CategoryNotFoundException;
use App\Blog\Category\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Domain\Exception\ForbidenException;
use App\Shared\Domain\Security\CurrentUserProviderInterface;
use App\Shared\Domain\ValueObject\Uuid;

class UpdateCategoryService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private CurrentUserProviderInterface $currentUserProvider
    ) { }

    public function update(Uuid $id, string $name): void
    {  
        $currentUser = $this->currentUserProvider->getRequiredCurrentUser();
        
        if (in_array('ROLE_ADMIN', $currentUser->getRoles()) === false) {
            throw new ForbidenException();
        }

        $category = $this->categoryRepository->findById($id);

        if ($category === null) {
            throw new CategoryNotFoundException();
        }

        $category->setName($name);

        $this->categoryRepository->save($category);
    }
}