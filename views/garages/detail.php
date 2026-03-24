<?php
/** @var object $garage */
/** @var object $clientContext */
?>

<div class="detail-container">
    <h2>Détails du garage</h2>
    <ul>
        <li><strong>Nom :</strong> <?= htmlspecialchars($garage->nom) ?></li>
        <li><strong>Adresse :</strong> <?= htmlspecialchars($garage->adresse) ?></li>
    </ul>
    <button id="back-btn" data-module="garages">← Retour</button>
</div>