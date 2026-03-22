<?php
require_once '../../../../utils/functions.php';
require_once '../../../../utils/cookie.php';

$clientCars = getCars(getClient());
$garagesById = getGaragesById();
?>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Marque</th>
            <th>Garage</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientCars as $car): ?>
        <tr data-id="<?= $car['id'] ?>">
            <td><?= htmlspecialchars(strtolower($car['modelName'])) ?></td>
            <td><?= htmlspecialchars($car['brand']) ?></td>
            <td><?= htmlspecialchars($garagesById[$car['garageId']]['title'] ?? 'Inconnu') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>