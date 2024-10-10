<?php

namespace App\Blog\Article\Domain\Service;

use App\Blog\Article\Domain\Exception\ArticleNotFoundException;
use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\Exception\ForbidenException;
use App\Shared\Domain\Security\CurrentUserProviderInterface;
use App\Shared\Domain\ValueObject\Uuid;

class DeleteArticleService
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private CurrentUserProviderInterface $currentUserProvider,
    ) { }

    public function delete(Uuid $id): void
    {
        $currentUser = $this->currentUserProvider->getRequiredCurrentUser();
        
        if (in_array('ROLE_ADMIN', $currentUser->getRoles()) === false) {
            throw new ForbidenException();
        }
        
        $article = $this->articleRepository->findById($id);

        if ($article === null) {
            throw new ArticleNotFoundException();
        }

        $this->articleRepository->delete($article);
    }
}