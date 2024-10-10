<?php

namespace App\Blog\Category\Infrastructure\Controller\Api;

use App\Blog\Category\Application\Command\UpdateCategory\UpdateCategoryCommand;
use App\Blog\Category\Infrastructure\ValidationDTO\UpdateCategoryInputDTO;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Categories')]
#[Route('/api/categories/{id}', name: 'api_update_category', methods: ['PUT'], requirements: ['id' => Requirement::UUID_V4])]
class UpdateCategoryController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(#[MapRequestPayload] UpdateCategoryInputDTO $dto, string $id): JsonResponse
    {
        $command = new UpdateCategoryCommand(
            new Uuid($id),
            $dto->name
        );

        $this->commandBus->execute($command);

        return $this->json(['message' => 'Category updated successfully'], 200);
    }
}