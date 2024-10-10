<?php

namespace App\Blog\Category\Infrastructure\ValidationDTO;

class UpdateCategoryInputDTO extends CreateCategoryInputDTO
{
    public function __construct(string $name) {
        parent::__construct($name);
    }
}