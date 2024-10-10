<?php

namespace App\Blog\Article\Application\Command\DeleteArticle;

use App\Blog\Article\Domain\Service\DeleteArticleService;
use App\Shared\Application\Command\CommandHandlerInterface;

class DeleteArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(private DeleteArticleService $deleteArticleService) { }

    public function __invoke(DeleteArticleCommand $command): void
    {
        $this->deleteArticleService->delete($command->id);
    }
}