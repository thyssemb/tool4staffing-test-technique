<?php
require_once '../../../../utils/functions.php';
require_once '../../../../utils/cookie.php';
require_once '../../../../utils/error.php';

use function Utils\Data\getCars;
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
            <th>Couleur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientCars as $car): ?>
        <tr data-id="<?= $car['id'] ?>">
            <td><?= htmlspecialchars($car['modelName']) ?></td>
            <td><?= htmlspecialchars($car['brand']) ?></td>
            <td>
                <span style="display:inline-block; width:20px; height:20px; background:<?= $car['colorHex'] ?>; border-radius:50%;"></span>
                <?= htmlspecialchars($car['colorHex']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>