<?php
function getClient(): string {
    $config = require __DIR__ . '/../config.php';
    $client = $_COOKIE['client'] ?? $config['allowed_clients'][0];
    return in_array($client, $config['allowed_clients']) ? $client : $config['allowed_clients'][0];
}