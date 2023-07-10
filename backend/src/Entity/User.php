<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('email', message: 'Email already exists (1).')]
class User
{
    /**
     * Primary key
     * @var int|null $id
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null $name
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var string|null $email
     */
    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email]
    #[Groups(['ignore'])]
    private ?string $email = null;

    /**
     * @var string|null $password
     */
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * Summary of getId
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Summary of getName
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Summary of setName
     * @param string $name
     * @return static(App\Entity\User)
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Summary of getEmail
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Summary of setEmail
     * @param string $email
     * @return static(App\Entity\User)
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getPassword(): ?string {
		return $this->password;
	}
	
	/**
	 * @param  $password 
	 * @return self
	 */
	public function setPassword(?string $password): self {
		$this->password = $password;
		return $this;
	}
}
