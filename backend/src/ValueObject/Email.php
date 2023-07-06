<?php

namespace App\ValueObject;

use InvalidArgumentException;

class Email
{
    private $address;

    public function __construct(string $address)
    {
        // Add any validation or formatting logic for the email address
        $this->validate($address);
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    private function validate(string $address): void
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address');
        }
    }
}