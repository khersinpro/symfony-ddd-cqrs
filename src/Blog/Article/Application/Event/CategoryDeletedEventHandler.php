<?php

namespace App\Blog\Article\Application\Event;

use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Blog\Category\Domain\Event\CategoryDeletedEvent;
use App\Shared\Application\Event\EventHandlerInterface;

class CategoryDeletedEventHandler implements EventHandlerInterface
{
    public function __construct(private ArticleRepositoryInterface $articleRepository) { }

    public function __invoke(CategoryDeletedEvent $event): void
    {
        $this->articleRepository->removeDeletedCategoryIds($event->id);
    }
}