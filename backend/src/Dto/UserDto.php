<?php

namespace App\Dto;

use App\ValueObject\Email;

class UserDto
{
    private ?int $id = null;

    private ?string $name = null;

    private ?Email $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * @param  $id 
	 * @return self
	 */
	public function setId(?int $id): self {
		$this->id = $id;
		return $this;
	}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): static
    {
        $this->email = $email;

        return $this;
    }
}
