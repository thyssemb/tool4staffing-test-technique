<?php
require_once '../../../../utils/functions.php';
require_once '../../../../utils/cookie.php';
require_once '../../../../utils/error.php';

use function Utils\Data\getCars;
use function Utils\Data\getCarAgeClass;
use function Utils\Error\renderError;
use function Utils\Cookie\getClient;

try {
    $clientCars = getCars(getClient());
} catch (\RuntimeException $e) {
    renderError($e->getMessage());
    return;
}
?>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Marque</th>
            <th>Année</th>
            <th>Puissance</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientCars as $car): ?>
        <tr data-id="<?= $car['id'] ?>" class="<?= getCarAgeClass($car['year']) ?>">
            <td><?= htmlspecialchars($car['modelName']) ?></td>
            <td><?= htmlspecialchars($car['brand']) ?></td>
            <td><?= date('Y', $car['year']) ?></td>
            <td><?= $car['power'] ?> ch</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>