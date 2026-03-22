<?php
require_once '../../../../utils/functions.php';
require_once '../../../../utils/error.php';

use function Utils\Data\getCarById;
use function Utils\Error\renderError;

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

try {
    $car = $id ? getCarById($id) : null;
} catch (\RuntimeException $e) {
    renderError($e->getMessage());
    return;
}

if (!$car) {
    renderError('Voiture introuvable.');
    return;
}
?>

<button id="back-btn">← Retour</button>

<h2><?= htmlspecialchars($car['modelName']) ?></h2>

<ul>
    <li><strong>Marque :</strong> <?= htmlspecialchars($car['brand']) ?></li>
    <li><strong>Année :</strong> <?= date('Y', $car['year']) ?></li>
    <li><strong>Puissance :</strong> <?= $car['power'] ?> ch</li>
    <li><strong>Couleur :</strong>
        <span style="display:inline-block; width:20px; height:20px; background:<?= $car['colorHex'] ?>; border-radius:50%;"></span>
        <?= htmlspecialchars($car['colorHex']) ?>
    </li>
</ul>