<?php
namespace App\Controller;

use App\Service\GarageService;
use App\Repository\GarageRepository;
use App\Security\ClientContext;

class GarageController
{
    private GarageService $service;

    public function __construct()
    {
        $this->service = new GarageService(
            new GarageRepository(),
            new ClientContext()
        );
    }

    public function list()
    {
        $garages = $this->service->getGaragesForClient();
        require __DIR__ . '/../../views/garages/list.php';
    }

    public function show()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $garage = $this->service->getGarageById($id);

        if (!$garage) {
            http_response_code(404);
            echo "Garage introuvable";
            return;
        }

        require __DIR__ . '/../../views/garages/detail.php';
    }
}