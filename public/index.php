<?php
declare(strict_types=1);

use App\Core\Router;

// Debug
error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/../vendor/autoload.php';

// Init router
$router = new Router();

/**
 * ROUTES
 */
$router->get('/cars', [App\Controller\CarController::class, 'list']);
$router->get('/cars/show', [App\Controller\CarController::class, 'show']);
$router->get('/garages', [App\Controller\GarageController::class, 'list']);
$router->get('/garages/show', [App\Controller\GarageController::class, 'show']);

/**
 * DISPATCH pour les routes API
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (in_array($uri, ['/cars','/cars/show','/garages','/garages/show'])) {
    $router->dispatch();
    exit;
}

/**
 * Sinon, servir le front HTML
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool4cars</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#1B2B4B',
                        brand: '#FF5A36',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50 min-h-screen">

<!-- Header -->
<header class="bg-navy shadow-md">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-white text-xl font-bold tracking-wide">Tool4cars</h1>
        <div class="flex gap-2">
            <button data-client="clienta" class="client-btn px-3 py-1 text-sm rounded bg-white/10 text-white hover:bg-white/20 transition">Client A</button>
            <button data-client="clientb" class="client-btn px-3 py-1 text-sm rounded bg-white/10 text-white hover:bg-white/20 transition">Client B</button>
            <button data-client="clientc" class="client-btn px-3 py-1 text-sm rounded bg-white/10 text-white hover:bg-white/20 transition">Client C</button>
        </div>
    </div>
</header>

<!-- Module nav -->
<div id="module-nav" class="hidden bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-3 flex gap-4">
        <button data-module="cars" class="module-btn px-3 py-1 text-sm rounded text-gray-700 hover:text-brand transition font-medium">Voitures</button>
        <button data-module="garages" class="module-btn px-3 py-1 text-sm rounded text-gray-700 hover:text-brand transition font-medium">Garages</button>
    </div>
</div>

<!-- Contenu dynamique -->
<main class="max-w-6xl mx-auto px-6 py-8">
    <div class="dynamic-div"></div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>