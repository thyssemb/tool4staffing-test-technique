<?php

namespace App\Service;

use App\Repository\CarRepository;
use App\Security\ClientContext;

class CarService
{
    private array $config;

    public function __construct(
        private CarRepository $repo,
        private ClientContext $clientContext
    ) {
        $this->config = include __DIR__ . '/../../config.php';
    }

    public function getCarsForClient(): array
    {
        $client = $this->clientContext->getClient();
        $cars = $this->repo->findAll();

        // filtrer par client
        $cars = array_filter($cars, fn($car) => $car->client === $client);

        // config client
        $fields = $this->config['clients'][$client]['showFields'] ?? [];

        foreach ($cars as $car) {
            $car->visibleFields = $fields;
        }

        return $cars;
    }
}