<?php

namespace App\Service;

use App\Repository\GarageRepository;
use App\Security\ClientContext;

class GarageService
{
    private array $config;

    public function __construct(
        private GarageRepository $repo,
        private ClientContext $clientContext
    ) {
        $this->config = include __DIR__ . '/../../config.php';
    }

    public function getGaragesForClient(): array
    {
        $client = $this->clientContext->getClient();
        $garages = $this->repo->findAll();

        // filtrer par client
        $garages = array_filter($garages, fn($garage) => $garage->client === $client);
        $garages = array_values($garages); // Réindexer le tableau

        return $garages;
    }

    public function getGarageById(int $id): ?\App\Model\Garage
    {
        $garage = $this->repo->findById($id);

        if (!$garage) {
            return null;
        }

        // Vérifier que le garage appartient au client
        $client = $this->clientContext->getClient();
        if ($garage->client !== $client) {
            return null;
        }

        return $garage;
    }
}
