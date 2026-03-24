<?php

namespace App\Repository;

use App\Model\Garage;

class GarageRepository
{
    private string $file = __DIR__ . '/../../data/garages.json';

    public function findAll(): array
    {
        $data = json_decode(file_get_contents($this->file), true);

        return array_map(fn($garage) => new Garage(
            $garage['id'],
            $garage['title'],
            $garage['address'],
            $garage['customer'] ?? $garage['client'] ?? 'clienta'  // Fix: JSON uses 'customer'
        ), $data);
    }

    public function findById(int $id): ?Garage
    {
        foreach ($this->findAll() as $garage) {
            if ($garage->id === $id) {
                return $garage;
            }
        }
        return null;
    }
}
