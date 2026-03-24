<?php

use PHPUnit\Framework\TestCase;
use App\Model\Car;

class CarTest extends TestCase
{
    private function makeCar(int $timestamp): Car
    {
        return new Car(1, 'Test', 'Brand', $timestamp, 200, '#FF0000', 'clienta');
    }

    public function test_car_older_than_10_years_returns_old_car(): void
    {
        $car = $this->makeCar(strtotime('-11 years'));
        $this->assertSame('old-car', $car->getAgeClass());
    }

    public function test_car_newer_than_2_years_returns_new_car(): void
    {
        $car = $this->makeCar(strtotime('-1 year'));
        $this->assertSame('new-car', $car->getAgeClass());
    }

    public function test_car_between_2_and_10_years_returns_empty(): void
    {
        $car = $this->makeCar(strtotime('-5 years'));
        $this->assertSame('', $car->getAgeClass());
    }

    public function test_car_exactly_10_years_returns_empty(): void
    {
        $car = $this->makeCar(strtotime('-10 years'));
        $this->assertSame('', $car->getAgeClass());
    }

    public function test_car_exactly_2_years_returns_empty(): void
    {
        $car = $this->makeCar(strtotime('-2 years'));
        $this->assertSame('', $car->getAgeClass());
    }
}