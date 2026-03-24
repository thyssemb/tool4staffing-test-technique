<?php

namespace App\Model;

class Garage
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $adresse,
        public string $client
    ) {}
}