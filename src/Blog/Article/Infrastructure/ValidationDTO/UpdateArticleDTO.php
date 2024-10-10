<?php

namespace App\Blog\Article\Infrastructure\ValidationDTO;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateArticleDTO
{
    public function __construct(
        #[Assert\NotBlank(message: 'Article title cannot be blank.')]
        #[Assert\Length(
            min: 3, minMessage: 'Article title must be at least 3 characters long.',
            max: 255, maxMessage: 'Article title cannot be longer than 255 characters.'
        )]
        public string $title,
    
        #[Assert\NotBlank(message: 'Article content cannot be blank.')]
        #[Assert\Length(min: 3, minMessage: 'Article content must be at least 3 characters long.')]
        public string $content,

        #[Assert\NotBlank(message: 'Article category cannot be blank.')]
        public string $category_id,
    ) { }
}