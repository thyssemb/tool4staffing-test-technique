<?php
require_once '../../../../utils/data.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$car = $id ? getCarById($id) : null;

if (!$car) {
    echo '<p>Voiture introuvable.</p>';
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