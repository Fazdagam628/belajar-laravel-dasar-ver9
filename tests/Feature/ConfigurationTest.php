<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals("Fauzan", $firstName);
        self::assertEquals("masud Ramadhani", $lastName);
        self::assertEquals("Fauzan@gmail.com", $email);
        self::assertEquals("https://www.programmerzamannow.com", $web);
    }
}