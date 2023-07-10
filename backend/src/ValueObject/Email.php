<?php

namespace App\ValueObject;

use InvalidArgumentException;

/**
 * Email type Value Object.
 */
class Email
{
    /**
     * @var 
     */
    private $address;

    /**
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->validate($address);
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @throws \InvalidArgumentException
     * @return void
     */
    private function validate(string $address): void
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address');
        }
    }
}