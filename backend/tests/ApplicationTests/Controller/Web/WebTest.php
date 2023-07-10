<?php

namespace App\Tests\ApplicationTests\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebTest extends WebTestCase
{
    /**
     * Catch $crawled object to reuse it.
     * @var 
     */
    private $crawler;

    /**
     * Test user form structure.
     * @return void
     */
    public function testUserPage(): void
    {
        $client = static::createClient();
        $client->request('GET', $_ENV['FRONT_URL'] . '/user');
        $this->crawler = $client->getCrawler();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextNotContains('p#userId', 'User ID:');
        $this->assertSelectorTextContains('form[name="user_management_form"]', 'Email');
        $this->assertSelectorTextContains('form[name="user_management_form"]', 'Name');
    }

    /**
     * Test User subbmitted form with errors.
     * @return void
     */
    public function testSubmitFormError(): void
    {
        $client = static::createClient();
        $client->request('GET', $_ENV['FRONT_URL'] . '/user');
        $this->crawler = $client->getCrawler();

        $this->assertResponseIsSuccessful();
        
        $form = $this->crawler->selectButton('Send')->form();

        $this->crawler = $client->submitForm('Send', [
            'user_management_form[email]' => 'invalid_email@x',
            'user_management_form[name]' => 'nametest',
        ]);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('form[name="user_management_form"]', 'This value is not a valid email address');
    }

    /**
     * Test submitted form with right values.
     * @return void
     */
    public function testSubmitFormOk(): void
    {
        $client = static::createClient();
        $client->request('GET', $_ENV['FRONT_URL'] . '/user');
        $this->crawler = $client->getCrawler();

        $this->assertResponseIsSuccessful();
        
        $form = $this->crawler->selectButton('Send')->form();

        $this->crawler = $client->submitForm('Send', [
            'user_management_form[email]' => 'valid@email.com',
            'user_management_form[name]' => 'nametest',
        ]);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('p#userId', 'User ID:');
    }

}
