<?php
function loadJson(string $filename): array {
    return json_decode(file_get_contents(__DIR__ . '/../data/' . $filename), true);
}

function getCars(string $client): array {
    return array_filter(loadJson('cars.json'), fn($car) => $car['customer'] === $client);
}

function getCarById(int $id): ?array {
    foreach (loadJson('cars.json') as $car) {
        if ($car['id'] === $id) return $car;
    }
    return null;
}

function getGarages(): array {
    return loadJson('garages.json');
}

function getGaragesById(): array {
    $indexed = [];
    foreach (getGarages() as $garage) {
        $indexed[$garage['id']] = $garage;
    }
    return $indexed;
}

function getGarageById(int $id): ?array {
    return getGaragesById()[$id] ?? null;
}

function getGaragesByClient(string $client): array {
    return array_filter(getGarages(), fn($garage) => $garage['customer'] === $client);
}

function getCarAgeClass(int $timestamp): string {
    $ageInYears = (time() - $timestamp) / (365.25 * 24 * 3600);

    if ($ageInYears > 10) return 'old-car';
    if ($ageInYears < 2) return 'new-car';
    return '';
}