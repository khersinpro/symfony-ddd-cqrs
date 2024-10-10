<?php

namespace App\Blog\Article\Application\Event;

use App\Blog\Article\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Application\Event\EventHandlerInterface;
use App\User\Domain\Event\UserDeletedEvent;


class UserDeletedEventHandler implements EventHandlerInterface
{
    public function __construct(private ArticleRepositoryInterface $articleRepository) { }

    public function __invoke(UserDeletedEvent $event): void
    {   
        $this->articleRepository->deleteByAuthorId($event->id);
    }
}   