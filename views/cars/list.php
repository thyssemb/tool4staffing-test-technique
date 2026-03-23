<?php
/** @var array $cars */
/** @var object $clientContext */
$fields = $cars[0]->visibleFields ?? [];
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
            <?php foreach ($cars as $car): ?>
                <tr class="<?= $car->getAgeClass() ?>" onclick="loadCar(<?= $car->id ?>)">
                    <?php foreach ($car->visibleFields as $f): ?>
                        <td>
                            <?php if ($f === 'color'): ?>
                                <span style="width:20px; height:20px; display:inline-block; border-radius:50%; background:<?= $car->colorHex ?>;"></span>
                            <?php else: ?>
                                <?= htmlspecialchars($car->$f) ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>