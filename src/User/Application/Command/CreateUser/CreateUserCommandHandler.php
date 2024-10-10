<?php

namespace App\User\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private UserFactory $userFactory
    ) { }

    public function __invoke(CreateUserCommand $command)
    {
        $user = $this->userFactory->create(
            $command->userName, 
            $command->email, 
            $command->password
        );

        $this->repository->save($user);

        return $user;
    }
}