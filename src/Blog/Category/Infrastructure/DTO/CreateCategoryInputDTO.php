<?php

namespace App\Blog\Category\Infrastructure\ValidationDTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateCategoryInputDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(
            min: 3,
            minMessage: 'The name must be at least 3 characters long.',
            max: 45,
            maxMessage: 'The name cannot be longer than 45 characters.'
        )]
        public readonly string $name
    ) { }
}