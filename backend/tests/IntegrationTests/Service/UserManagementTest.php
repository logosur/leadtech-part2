<?php
namespace App\Tests\IntegrationTests\Service;

use App\Service\UserManagement;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserManagementTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * Setup initial values. Interfaces and services needed for testings.
     * @return void
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * Test when we insert a new User given by addOrUpdateByEmail service method when we
     * run the method again with the same email, the id is the same, so this has been updated.
     * @return void
     */
    public function testAddOrUpdate()
    {
        $userManagement = new UserManagement($this->em);

        $email = microtime() . '@domain.com';
        $name = microtime();

        $curUser = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        $this->assertNull($curUser);

        $user = new User();
        $user->setEmail($email);
        $user->setName($name);

        
        $user = $userManagement->addOrUpdateByEmail($user);
        $curUser = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        $this->assertEquals($email, $curUser->getEmail());
        $this->assertEquals($name, $curUser->getName());

        $name = microtime();
        $user->setName($name);
        $user = $userManagement->addOrUpdateByEmail($user);
        $curUser1 = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        $this->assertEquals($email, $curUser->getEmail());
        $this->assertEquals($name, $curUser->getName());
        $this->assertEquals($curUser1->getId(), $user->getId());
    }
}
