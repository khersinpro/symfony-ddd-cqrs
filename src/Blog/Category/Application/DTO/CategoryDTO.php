<?php

namespace App\Blog\Category\Application\DTO;

class CategoryDTO 
{
    public function __construct(
        public string $id,
        public string $name
    ) { }
}