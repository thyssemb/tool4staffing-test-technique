<?php
/** @var array $cars */

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

// Récupérer les champs depuis la première voiture ou depuis la config
$fields = [];
if (!empty($cars)) {
    $fields = $cars[0]->visibleFields ?? [];
} else {
    // Fallback: récupérer depuis le cookie et la config
    $client = $_COOKIE['client'] ?? 'clienta';
    $config = include __DIR__ . '/../../config.php';
    $fields = $config['clients'][$client]['showFields'] ?? [];
}
?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <?php foreach ($fields as $f): ?>
                    <th><?= getHeaderLabel($f) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($cars)): ?>
                <tr>
                    <td colspan="<?= count($fields) ?>" style="text-align: center; padding: 20px; color: #6b7280;">
                        Aucun véhicule trouvé pour ce client.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($cars as $car): ?>
                    <tr class="<?= $car->getAgeClass() ?>" onclick="loadCar(<?= $car->id ?>)">
                        <?php foreach ($car->visibleFields as $f): ?>
                            <td>
                                <?php if ($f === 'color' || $f === 'couleur'): ?>
                                    <span style="width:20px; height:20px; display:inline-block; border-radius:50%; background:<?= $car->couleurHex ?>;" title="<?= htmlspecialchars($car->couleurHex) ?>"></span>
                                <?php elseif ($f === 'year'): ?>
                                    <?= htmlspecialchars($car->getFormattedYear()) ?>
                                <?php elseif ($f === 'modelName' && $car->client === 'clientb'): ?>
                                    <?= htmlspecialchars(strtolower($car->$f ?? '')) ?>
                                <?php else: ?>
                                    <?= htmlspecialchars($car->$f ?? '') ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>