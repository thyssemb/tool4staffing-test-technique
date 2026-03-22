<?php
require_once '../../../../utils/data.php';
require_once '../../../../utils/cookie.php';

$garages = getGaragesByClient(getClient());
?>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($garages as $garage): ?>
        <tr data-id="<?= $garage['id'] ?>">
            <td><?= htmlspecialchars($garage['title']) ?></td>
            <td><?= htmlspecialchars($garage['address']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>