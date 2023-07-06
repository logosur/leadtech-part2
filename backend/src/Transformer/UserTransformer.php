<?php

namespace App\Transformer;

use App\Entity\User;
use App\Dto\UserDto;
use App\ValueObject\Email;
use Symfony\Component\Form\Form;

class UserTransformer
{
    public static function fromUserToDto(User $user): UserDto
    {
        $userDto = new UserDto();
        $userDto->setId($user->getId());
        $userDto->setEmail(new Email($user->getEmail()));
        $userDto->setName($user->getName());

        return $userDto;
    }

    public static function formToDto(Form $form): UserDto
    {
        $userDto = new UserDto();
        $userDto->setEmail(new Email($form->get('email')->getData()));
        $userDto->setName($form->get('name')->getData());

        return $userDto;
    }
}