<?php
require_once '../../../../utils/functions.php';
require_once '../../../../utils/cookie.php';
require_once '../../../../utils/error.php';

use function Utils\Data\getGaragesByClient;
use function Utils\Error\renderError;

try {
    $garages = getGaragesByClient(getClient());
} catch (\RuntimeException $e) {
    renderError($e->getMessage());
    return;
}
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