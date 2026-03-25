<?php

namespace App\Service;

use App\Repository\CarRepository;
use App\Repository\GarageRepository;
use App\Security\ClientContext;

class CarService
{
    private array $config;
    private ?array $garagesCache = null;

    public function __construct(
        private CarRepository $repo,
        private ClientContext $clientContext
    ) {
        $this->config = include __DIR__ . '/../../config.php';
    }

    private function getGarages(): array
    {
        if ($this->garagesCache === null) {
            $garageRepo = new GarageRepository();
            $this->garagesCache = [];
            foreach ($garageRepo->findAll() as $garage) {
                $this->garagesCache[$garage->id] = $garage->nom;
            }
        }
        return $this->garagesCache;
    }

    public function getCarsForClient(): array
    {
        $client = $this->clientContext->getClient();
        $cars = $this->repo->findAll();

        // filtrer par client
        $cars = array_filter($cars, fn($car) => $car->client === $client);
        $cars = array_values($cars); // Réindexer le tableau

        // config client
        $fields = $this->config['clients'][$client]['showFields'] ?? [];
        $garages = in_array('garage', $fields) ? $this->getGarages() : [];

        foreach ($cars as $car) {
            $car->visibleFields = $fields;
            if (in_array('garage', $fields) && $car->garageId) {
                $car->garage = $garages[$car->garageId] ?? "Garage #{$car->garageId}";
            }
        }

        return $cars;
    }

    public function getCarById(int $id): ?\App\Model\Car
    {
        $car = $this->repo->findById($id);

        if (!$car) {
            return null;
        }

        $client = $this->clientContext->getClient();
        if ($car->client !== $client) {
            return null;
        }

        $fields = $this->config['clients'][$client]['showFields'] ?? [];
        $car->visibleFields = $fields;

        if (in_array('garage', $fields) && $car->garageId) {
            $garages = $this->getGarages();
            $car->garage = $garages[$car->garageId] ?? "Garage #{$car->garageId}";
        }

        return $car;
    }
}