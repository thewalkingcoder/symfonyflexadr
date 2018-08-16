<?php
namespace App\Tests\User\Action;



use App\DataFixtures\UserFixtures;
use Liip\FunctionalTestBundle\Test\WebTestCase;

final class UserUpdateActionTest extends WebTestCase
{
    public function testUserCreateFormView()
    {
        $client = $this->makeClient();
        $this->loadFixtures([
            UserFixtures::class
        ]);

        $crawler = $client->request('GET', '/update/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $boutton = $crawler->filter('button:contains("Enregistrer")')->count();

        $this->assertEquals(1, $boutton);
    }


    public function testUserUpdate()
    {
        $client = $this->makeClient();
        $this->loadFixtures([
            UserFixtures::class
        ]);
        $client->followRedirects();
        $crawler = $client->request('GET', '/update/1');
        $form = $crawler->selectButton('buttonUser')->form();

        $inputValue = $form->get('user_form[nom]')->getValue();

        $this->assertSame('WALKING CODER', $inputValue);

        $form["user_form[nom]"] = 'TOTO';
        $crawler = $client->submit($form);

        $this->assertContains('Modification réalisée',
            $client->getResponse()->getContent());

        $inputValue = $form->get('user_form[nom]')->getValue();

        $this->assertSame('TOTO', $inputValue);
    }

    public function testUserUpdate_byUserExist()
    {
        $client = $this->makeClient();
        $this->loadFixtures([
            UserFixtures::class
        ]);
        $client->followRedirects();
        $crawler = $client->request('GET', '/update/1');
        $form = $crawler->selectButton('buttonUser')->form();
        $form["user_form[nom]"] = 'MARCEL';
        $crawler = $client->submit($form);

        $this->assertContains('Le user MARCEL existe déjà',
            $client->getResponse()->getContent());
    }

}