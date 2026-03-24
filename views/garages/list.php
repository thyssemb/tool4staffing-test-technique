<?php
/** @var array $garages */
/** @var object $clientContext */
$fields = ['nom', 'adresse'];

function getHeaderLabel($field) {
    $labels = [
        'nom' => 'Nom du garage',
        'adresse' => 'Adresse'
    ];
    return $labels[$field] ?? ucfirst($field);
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
            <?php foreach ($garages as $garage): ?>
                <tr onclick="loadGarage(<?= $garage->id ?>)">
                    <td><?= htmlspecialchars($garage->nom) ?></td>
                    <td><?= htmlspecialchars($garage->adresse) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>