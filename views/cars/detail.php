<?php
/** @var object $car */
/** @var object $clientContext */
?>

<ul>
    <?php foreach ($car->visibleFields as $f): ?>
        <li>
            <strong><?= ucfirst($f) ?>:</strong>
            <?php if ($f === 'color'): ?>
                <span style="width:20px; height:20px; display:inline-block; border-radius:50%; background:<?= $car->colorHex ?>;"></span>
            <?php else: ?>
                <?= htmlspecialchars($car->$f) ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<button id="back-btn" data-module="cars">← Retour</button>