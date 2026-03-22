<?php
require_once '../../../../utils/data.php';
require_once '../../../../utils/cookie.php';

$clientCars = getCars(getClient());
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