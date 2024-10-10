<?php

namespace App\Blog\Article\Application\Command\CreateArticle;

use App\Blog\Article\Application\DTO\ArticleDTO;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\Blog\Article\Domain\Entity\Article;
use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\Security\CurrentUserProviderInterface;
use App\Shared\Domain\UuidGenerator\UuidGeneratorInterface;

class CreateArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private UserRepositoryInterface $userRepository,
        private UuidGeneratorInterface $uuidGenerator,
        private CurrentUserProviderInterface $currentUserProvider
    ) { }

    public function __invoke(CreateArticleCommand $command): ArticleDTO
    {
        $author = $this->currentUserProvider->getRequiredCurrentUser();

        $article = new Article(
            new Uuid($this->uuidGenerator->generate()),
            $command->title,
            $command->content,
            new Uuid($author->getId()),
            $command->category_id
        );

        $this->articleRepository->save($article);

        return new ArticleDTO(
            $article->getId()->__toString(),
            $article->getTitle(),
            $article->getContent(),
            $article->getCategoryId()->__toString()
        );
    }
}