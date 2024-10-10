<?php

namespace App\Blog\Article\Application\Command\UpdateArticle;

use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Blog\Article\Domain\Service\UpdateArticleService;
use App\Shared\Application\Command\CommandHandlerInterface;

class UpdateArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private UpdateArticleService $updateArticleService
    ) { }

    public function __invoke(UpdateArticleCommand $command): void
    {
        $this->updateArticleService->update(
            $command->id,
            $command->title,
            $command->content,
            $command->category_id
        );
    }
}