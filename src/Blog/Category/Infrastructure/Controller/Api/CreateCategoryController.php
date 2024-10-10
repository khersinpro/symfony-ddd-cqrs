<?php

namespace App\Blog\Category\Infrastructure\Controller\Api;

use App\Blog\Category\Application\Command\CreateCategory\CreateCategoryCommand;
use App\Blog\Category\Infrastructure\ValidationDTO\CreateCategoryInputDTO;
use App\Shared\Application\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Categories')]
#[Route('/api/categories', name: 'api_create_category', methods: ['POST'])]
class CreateCategoryController extends AbstractController
{
    public function __construct(private CommandBusInterface $commandBus) { }

    public function __invoke(#[MapRequestPayload] CreateCategoryInputDTO $dto): JsonResponse
    {
        $command = new CreateCategoryCommand($dto->name);

        $this->commandBus->execute($command);

        return $this->json(['message' => 'Category created successfully'], 201);
    }


}