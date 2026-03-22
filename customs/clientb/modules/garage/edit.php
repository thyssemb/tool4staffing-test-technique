<?php
require_once '../../../../utils/data.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$garage = $id ? getGarageById($id) : null;

if (!$garage) {
    echo '<p>Garage introuvable.</p>';
    return;
}
?>

<button id="back-btn">← Retour</button>

<h2><?= htmlspecialchars($garage['title']) ?></h2>

<ul>
    <li><strong>Adresse :</strong> <?= htmlspecialchars($garage['address']) ?></li>
</ul>