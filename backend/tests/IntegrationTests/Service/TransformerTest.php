<?php
namespace App\Tests\IntegrationTests\Service;

use App\ValueObject\Email;
use PHPUnit\Framework\TestCase;
use App\Transformer\UserTransformer;
use App\Dto\UserDto;
use App\Entity\User;

/**
 * Test Transformer Service
 */
class TransformerTest extends TestCase
{
    /**
     * test FromUserToDto method.
     * @return void
     */
    public function testFromUserToDto()
    {
        $email = 'email@domain.com';
        $name = 'myname';
        $password = 'mypassword';

        $user = New User();
        $user->setEmail($email);
        $user->setName($name);
        $user->setPassword($password);

        $userDto = UserTransformer::FromUserToDto($user);

        $this->assertEquals($userDto->getName(), $name);
        $this->assertEquals($userDto->getEmail()->getAddress(), $email);
    }
}
