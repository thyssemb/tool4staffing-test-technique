<?php
/** @var object $car */

function getHeaderLabel($field) {
    $labels = [
        'modelName' => 'Nom du véhicule',
        'brand' => 'Marque',
        'year' => 'Année',
        'power' => 'Puissance (ch)',
        'color' => 'Couleur',
        'couleur' => 'Couleur',
        'garage' => 'Garage'
    ];
    return $labels[$field] ?? ucfirst($field);
}
?>

<div class="detail-container">
    <h2>Détails du véhicule</h2>
    <ul>
        <?php foreach ($car->visibleFields as $f): ?>
            <li>
                <strong><?= getHeaderLabel($f) ?>:</strong>
                <?php if ($f === 'color' || $f === 'couleur'): ?>
                    <span style="width:20px; height:20px; display:inline-block; border-radius:50%; background:<?= $car->couleurHex ?>;" title="<?= htmlspecialchars($car->couleurHex) ?>"></span>
                    <span><?= htmlspecialchars($car->couleurHex) ?></span>
                <?php elseif ($f === 'year'): ?>
                    <?= htmlspecialchars($car->getFormattedYear()) ?>
                <?php elseif ($f === 'modelName' && $car->client === 'clientb'): ?>
                    <?= htmlspecialchars(strtolower($car->$f ?? '')) ?>
                <?php else: ?>
                    <?= htmlspecialchars($car->$f ?? '') ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <button id="back-btn" data-module="cars">← Retour</button>
</div>