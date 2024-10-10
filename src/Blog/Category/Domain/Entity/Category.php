<?php

namespace App\Blog\Category\Domain\Entity;

use App\Blog\Category\Domain\Event\CategoryDeletedEvent;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;

class Category extends AggregateRoot
{
    public function __construct(
        private Uuid $id,
        private string $name
    ) { }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function delete(): void
    {
        $this->recordEvent(new CategoryDeletedEvent($this->id));
    }
}