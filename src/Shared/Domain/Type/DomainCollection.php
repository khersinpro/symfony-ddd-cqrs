<?php

namespace App\Shared\Domain\Type;

class DomainCollection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    private array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(mixed $item): void
    {
        $this->items[] = $item;
    }

    public function remove(mixed $item): void
    {
        $key = array_search($item, $this->items, true);

        if ($key !== false) {            
            unset($this->items[$key]);
        }
    }

    /**
     * @return array<mixed>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }         

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }
}