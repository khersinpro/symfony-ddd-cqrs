<?php

namespace App\User\Infrastructure\Controller\Api;

use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\ChangePassword\ChangePasswordCommand;
use App\User\Infrastructure\DTO\UpdatePasswordDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Users')]
#[Route('/api/users/password', name: 'api_users_change_password', methods: ['PUT'])]
class ChangePasswordController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(#[MapRequestPayload] UpdatePasswordDTO $updatePasswordDTO): JsonResponse  
    {
        $command = new ChangePasswordCommand($updatePasswordDTO->password);
        $this->commandBus->execute($command);

        return $this->json(null, 204);
    }
}