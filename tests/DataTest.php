<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils/functions.php';

use function Utils\Data\loadJson;

class DataTest extends TestCase
{
    public function test_load_valid_json_returns_array(): void
    {
        $result = loadJson('cars.json');
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_load_missing_file_throws_exception(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/introuvable/');
        loadJson('nonexistent.json');
    }

    public function test_load_invalid_json_throws_exception(): void
    {
        file_put_contents(__DIR__ . '/../data/test_invalid.json', '{invalid json}');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/JSON invalide/');
        loadJson('test_invalid.json');

        unlink(__DIR__ . '/../data/test_invalid.json');
    }
}