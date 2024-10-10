<?php

namespace App\User\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public string $userName,
        public string $email,
        public string $password,
        public array $roles = []
    ) { }
}