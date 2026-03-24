<?php

namespace App\Model;

class Car
{
    public ?string $garage = null;
    public array $visibleFields = [];

    public function __construct(
        public int $id,
        public string $nomModele,
        public string $marque,
        public int $annee,
        public int $puissance,
        public string $couleurHex,
        public string $client,
        public ?int $garageId = null
    ) {}

    public function __get(string $name)
    {
        return match($name) {
            'modelName' => $this->nomModele,
            'brand' => $this->marque,
            'year' => $this->annee,
            'power' => $this->puissance,
            'color' => $this->couleurHex,
            'colorHex' => $this->couleurHex,
            'couleur' => $this->couleurHex,
            'formattedYear' => $this->getFormattedYear(),
            'ageClass' => $this->getAgeClass(),
            default => null
        };
    }

    public function getFormattedYear(): string
    {
        return date('Y', $this->annee);
    }

    public function getAge(): int
    {
        return date('Y') - date('Y', $this->annee);
    }

    public function getAgeClass(): string
    {
        $age = $this->getAge();

        if ($age > 10) return 'old-car';
        if ($age < 2) return 'new-car';

        return '';
    }
}