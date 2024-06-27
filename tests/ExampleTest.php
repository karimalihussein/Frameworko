<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testTrueAssertsToTrue()
    {
        $this->assertTrue(true);
    }

    public function testFalseAssertsToFalse()
    {
        $this->assertFalse(false);
    }
}