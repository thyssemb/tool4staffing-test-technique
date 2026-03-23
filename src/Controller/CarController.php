<?php
namespace App\Controller;

use App\Service\CarService;
use App\Security\ClientContext;

class CarController
{
    private CarService $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        $cars = $this->service->getCarsForClient();
        require __DIR__ . '/../../views/cars/list.php';
    }

    public function show()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $car = $this->service->getCarById($id);

        if (!$car) {
            http_response_code(404);
            echo "Voiture introuvable";
            return;
        }

        require __DIR__ . '/../../views/cars/detail.php';
    }
}