<?php
namespace App\Security;

class ClientContext
{
    private array $whitelist;

    public function __construct()
    {
        $config = include __DIR__ . '/../../config.php';
        $this->whitelist = $config['clients'] ?? [];
    }

    public function getClient(): string
    {
        $client = $_COOKIE['client'] ?? '';
        if (!in_array($client, array_keys($this->whitelist))) {
            throw new \RuntimeException("Client non autorisé");
        }
        return $client;
    }
}