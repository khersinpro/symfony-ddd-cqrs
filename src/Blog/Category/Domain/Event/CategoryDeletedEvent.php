<?php

namespace App\Blog\Category\Domain\Event;

use App\Shared\Domain\Event\EventInterface;
use App\Shared\Domain\ValueObject\Uuid;

class CategoryDeletedEvent implements EventInterface
{
    public function __construct(public Uuid $id) { }
}