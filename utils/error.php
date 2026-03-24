<?php

namespace Utils\Error;

function renderError(string $message): void {
    error_log('Tool4cars ' . $message);
    echo '<p class="error">' . htmlspecialchars('Une erreur est survenue.') . '</p>';
}