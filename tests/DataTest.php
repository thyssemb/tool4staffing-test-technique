<?php

use PHPUnit\Framework\TestCase;
use App\Repository\CarRepository;

class DataTest extends TestCase
{
    public function test_load_cars_returns_array(): void
    {
        $repo = new CarRepository();
        $result = $repo->findAll();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_find_car_by_id_returns_car(): void
    {
        $repo = new CarRepository();
        $car = $repo->findById(1);
        $this->assertNotNull($car);
        $this->assertSame(1, $car->id);
    }

    public function test_find_car_by_invalid_id_returns_null(): void
    {
        $repo = new CarRepository();
        $car = $repo->findById(9999);
        $this->assertNull($car);
    }
}