<?php

namespace App\Service;

use App\Dto\UserDto;
use App\Entity\User;

interface UserManagementInterface
{
    /**
     * Add or update a user from a UserDto input.
     * @param UserDto $userDto
     * @return UserDto
     */
    public function addOrUpdateByEmailFromDto(UserDto $userDto): UserDto;

    /**
     * Add or update a user from a User input.
     * @param User $user
     * @return User
     */
    public function addOrUpdateByEmail(User $user): User;
}