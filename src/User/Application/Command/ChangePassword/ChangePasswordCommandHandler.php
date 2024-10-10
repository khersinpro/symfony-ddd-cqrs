<?php

namespace App\User\Application\Command\ChangePassword;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\CurrentUserProviderInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Service\UserPasswordService;

class ChangePasswordCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserPasswordService $userPasswordService,
        private CurrentUserProviderInterface $currentUserProvider
    ) { }

    public function __invoke(ChangePasswordCommand $command): void
    {
        $currentUser = $this->currentUserProvider->getRequiredCurrentUser();

        $this->userPasswordService->changePassword(
            new Uuid($currentUser->getId()), 
            $command->newPassword
        );
    }
}