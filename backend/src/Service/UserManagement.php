<?php

namespace App\Service;

use App\Entity\User;
use App\Dto\UserDto;
use App\Transformer\UserTransformer;
use Doctrine\ORM\EntityManagerInterface;

class UserManagement implements UserManagementInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Add or update a user from a UserDto input.
     * @param UserDto $userDto
     * @return UserDto
     */
    public function addOrUpdateByEmailFromDto(UserDto $userDto): UserDto
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

    /**
     * Add or update a user from a User input by Email.
     * @param User $user
     * @return User
     */
    public function addOrUpdateByEmail(User $user): User
    {
        $curUser = $this->em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

        if (!$curUser) {
            $curUser = new User();
            $curUser->setEmail($user->getEmail());
            $curUser->setName($user->getName());
            $curUser->setPassword(
                crypt(
                    $curUser->getEmail(),
                    microtime() . uniqid()
                )
            );
        } else {
            $curUser->setEmail($user->getEmail());
            $curUser->setName($user->getName());
        }

        $this->em->persist($curUser);
        $this->em->flush();

        return $curUser;
    }
}