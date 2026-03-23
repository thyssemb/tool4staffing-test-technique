<?php
declare(strict_types=1);

use App\Core\Router;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

// Cars routes
$router->get('/cars', [App\Controller\CarController::class, 'list']);
$router->get('/cars/show', [App\Controller\CarController::class, 'show']);

// Garage routes (Client B uniquement)
$router->get('/garages', [App\Controller\GarageController::class, 'list']);
$router->get('/garages/show', [App\Controller\GarageController::class, 'show']);

$router->dispatch();