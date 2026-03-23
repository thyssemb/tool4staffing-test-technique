<?php
/** @var array $garages */
/** @var object $clientContext */
$fields = ['title', 'address']; // Pour l'instant, fixe pour garage
?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <?php foreach ($fields as $f): ?>
                    <th><?= ucfirst($f) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($garages as $garage): ?>
                <tr onclick="loadGarage(<?= $garage->id ?>)">
                    <td><?= htmlspecialchars($garage->title) ?></td>
                    <td><?= htmlspecialchars($garage->address) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>