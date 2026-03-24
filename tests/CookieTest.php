<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils/cookie.php';
require_once __DIR__ . '/../config.php';

use function Utils\Cookie\getClient;

class CookieTest extends TestCase
{
    public function test_valid_client_is_returned(): void
    {
        $_COOKIE['client'] = 'clienta';
        $this->assertSame('clienta', getClient());
    }

    public function test_invalid_client_returns_default(): void
    {
        $_COOKIE['client'] = 'hacker';
        $this->assertSame('clienta', getClient());
    }

    public function test_missing_cookie_returns_default(): void
    {
        unset($_COOKIE['client']);
        $this->assertSame('clienta', getClient());
    }
}