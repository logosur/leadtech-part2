<?php

namespace App\Service;

use App\Entity\User;
use App\Dto\UserDto;
use App\Transformer\UserTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManagement
{
    private EntityManagerInterface $em;

    private UserPasswordHasherInterface $userPasswordHasher;
    
    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->em = $em;
        $this->userPasswordHasher = $userPasswordHasherInterface;
    }

    public function addOrUpdate(UserDto $userDto): UserDto
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $userDto->getEmail()->getAddress()]);

        if (!$user) {
            $user = new User();
            $user->setEmail($userDto->getEmail()->getAddress());
            $user->setName($userDto->getName());
            $user->setPassword(
                crypt(
                    $userDto->getEmail()->getAddress(),
                    microtime() . uniqid()
                )
            );
        } else {
            $user->setEmail($userDto->getEmail()->getAddress());
            $user->setName($userDto->getName());
        }

        $this->em->persist($user);
        $this->em->flush();

        $userDto = UserTransformer::fromUserToDto($user);

        return $userDto;
    }
}