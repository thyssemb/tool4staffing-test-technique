<?php

namespace App\Model;

class Car
{
    public function __construct(
        public int $id,
        public string $modelName,
        public string $brand,
        public int $year,
        public int $power,
        public string $colorHex,
        public string $client,
        public ?int $garageId = null
    ) {}

    public function getFormattedYear(): string
    {
        return date('Y', $this->year);
    }

    public function getAge(): int
    {
        return date('Y') - date('Y', $this->year);
    }

    public function getAgeClass(): string
    {
        $age = $this->getAge();

        if ($age > 10) return 'old-car';
        if ($age < 2) return 'new-car';

        return '';
    }
}