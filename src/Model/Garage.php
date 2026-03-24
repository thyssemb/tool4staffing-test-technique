<?php

namespace App\Model;

class Garage
{
    public function __construct(
        public int $id,
        public string $title,
        public string $address,
        public string $client
    ) {}
}