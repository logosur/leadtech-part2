<?php

namespace App\Tests\UnitTests;

use PHPUnit\Framework\TestCase;
use App\ValueObject\Email;

class EmailValueObject extends TestCase
{
    /**
     * Test invalid value for EmailDto
     * @return void
     */
    public function testInvalidValues(): void
    {
        $this->expectException(\Exception::class);
        $geo = new Email('bademail@domain');
    }

    /**
     * Test valid value for EmailDto
     * @return void
     */
    public function testValidValues(): void
    {
        $geo = new Email('goodemail@domain.com');
        $this->assertTrue(true);
    }
}
