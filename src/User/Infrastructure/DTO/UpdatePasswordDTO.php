<?php

namespace App\User\Infrastructure\DTO;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UpdatePasswordDTO
{
    public function __construct(
        #[Assert\NotBlank(message: 'Please enter your password')]
        #[Assert\Length(
            min: 6, 
            minMessage: 'Your password must be at least 6 characters long'
        )]
        public string $password,
    ){
    }
}