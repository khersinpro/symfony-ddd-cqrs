<?php

namespace App\Blog\Article\Application\DTO;

class AuthorDTO
{
    public function __construct(
        public string $id,
        public string $username
    ) { }
}