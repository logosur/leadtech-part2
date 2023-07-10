<?php

namespace App\Dto;

use App\ValueObject\Email;

/**
 * UserDto sample for this evaluation exercise.
 */
class UserDto
{
    /**
     * @var int|null $id
     */
    private ?int $id = null;

    /**
     * @var string|null $name
     */
    private ?string $name = null;

    /**
     * @var Email|null $email
     */
    private ?Email $email = null;

    /**
     * @return int|null
     */
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

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return static(App\Dto\UserDto)
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Email|null
     */
    public function getEmail(): ?Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     * @return static(App\Dto\UserDto)
     */
    public function setEmail(Email $email): static
    {
        $this->email = $email;

        return $this;
    }
}
