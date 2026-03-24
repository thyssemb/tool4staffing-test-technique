<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils/functions.php';

use function Utils\Data\getCarAgeClass;

class CarTest extends TestCase
{
    public function test_car_older_than_10_years_returns_old_car(): void
    {
        $timestamp = strtotime('-11 years');
        $this->assertSame('old-car', getCarAgeClass($timestamp));
    }

    public function test_car_newer_than_2_years_returns_new_car(): void
    {
        $timestamp = strtotime('-1 year');
        $this->assertSame('new-car', getCarAgeClass($timestamp));
    }

    public function test_car_between_2_and_10_years_returns_empty(): void
    {
        $timestamp = strtotime('-5 years');
        $this->assertSame('', getCarAgeClass($timestamp));
    }
}