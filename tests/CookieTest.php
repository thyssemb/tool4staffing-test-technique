<?php

use PHPUnit\Framework\TestCase;
use App\Security\ClientContext;

class CookieTest extends TestCase
{
    public function test_valid_client_is_returned(): void
    {
        $_COOKIE['client'] = 'clienta';
        $context = new ClientContext();
        $this->assertSame('clienta', $context->getClient());
    }

    public function test_invalid_client_returns_default(): void
    {
        $_COOKIE['client'] = 'hacker';
        $context = new ClientContext();
        $this->assertSame('clienta', $context->getClient());
    }

    public function test_missing_cookie_returns_default(): void
    {
        unset($_COOKIE['client']);
        $context = new ClientContext();
        $this->assertSame('clienta', $context->getClient());
    }
}