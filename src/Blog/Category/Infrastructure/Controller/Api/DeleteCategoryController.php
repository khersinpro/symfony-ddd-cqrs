<?php

namespace App\Blog\Category\Infrastructure\Controller\Api;

use App\Blog\Category\Application\Command\DeleteCategory\DeleteCategoryCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Categories')]
#[Route('/api/categories/{id}', name: 'api_delete_category', methods: ['DELETE'], requirements: ['id' => Requirement::UUID_V4])]
class DeleteCategoryController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(string $id): JsonResponse
    {
        $command = new DeleteCategoryCommand(
            new Uuid($id)
        );

        $this->commandBus->execute($command);

        return $this->json(null, 204);
    }
}