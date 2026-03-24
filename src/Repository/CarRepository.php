<?php

namespace App\Repository;

use App\Model\Car;

class CarRepository
{
    private string $file = __DIR__ . '/../../data/cars.json';

    public function findAll(): array
    {
        $data = json_decode(file_get_contents($this->file), true);

        return array_map(fn($car) => new Car(
            $car['id'],
            $car['modelName'] ?? '',
            $car['brand'] ?? '',
            $car['year'] ?? 0,
            $car['power'] ?? 0,
            $car['colorHex'] ?? '',
            $car['customer'] ?? $car['client'] ?? 'clienta',
            $car['garageId'] ?? null
        ), $data);
    }

    public function findById(int $id): ?Car
    {
        foreach ($this->findAll() as $car) {
            if ($car->id === $id) {
                return $car;
            }
        }
        return null;
    }
}