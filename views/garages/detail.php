<?php
/** @var object $garage */
/** @var object $clientContext */
?>

<ul>
    <li><strong>Nom :</strong> <?= htmlspecialchars($garage->title) ?></li>
    <li><strong>Adresse :</strong> <?= htmlspecialchars($garage->address) ?></li>
</ul>

<button id="back-btn" data-module="garages">← Retour</button>