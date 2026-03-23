<?php
require_once '../../../../utils/functions.php';
require_once '../../../../utils/error.php';

use function Utils\Data\getGarageById;
use function Utils\Error\renderError;

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

try {
    $garage = $id ? getGarageById($id) : null;
} catch (\RuntimeException $e) {
    renderError($e->getMessage());
    return;
}

if (!$garage) {
    renderError('Garage introuvable.');
    return;
}
?>

<div class="detail-container">
    <button id="back-btn">← Retour</button>

    <h2><?= htmlspecialchars($garage['title']) ?></h2>

    <ul>
        <li>
            <strong>Adresse :</strong>
            <?= htmlspecialchars($garage['address']) ?>
        </li>
    </ul>
</div>