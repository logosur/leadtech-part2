<?php

namespace App\Transformer;

use App\Entity\User;
use App\Dto\UserDto;
use App\ValueObject\Email;
use Symfony\Component\Form\Form;

/**
 * Transformations from and to UserDto object.
 */
class UserTransformer
{
    /**
     * Transform from User to UserDto.
     * @param User $user
     * @return UserDto
     */
    public static function fromUserToDto(User $user): UserDto
    {
        $userDto = new UserDto();
        $userDto->setId($user->getId());
        $userDto->setEmail(new Email($user->getEmail()));
        $userDto->setName($user->getName());

        return $userDto;
    }

    /**
     * Transform submitted form to UserDto.
     * @param Form $form
     * @return UserDto
     */
    public static function formToDto(Form $form): UserDto
    {
        $userDto = new UserDto();
        $userDto->setEmail(new Email($form->get('email')->getData()));
        $userDto->setName($form->get('name')->getData());

        return $userDto;
    }

    /**
     * Transform submitted form to User.
     * @param Form $form
     * @return User
     */
    public static function formToUser(Form $form): User
    {
        $userDto = new User();
        $userDto->setEmail($form->get('email')->getData());
        $userDto->setName($form->get('name')->getData());

        return $userDto;
    }
}