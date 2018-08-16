<?php
namespace App\Tests\User\Action;



use App\DataFixtures\UserFixtures;
use Liip\FunctionalTestBundle\Test\WebTestCase;

final class UserCreateActionTest extends WebTestCase
{
    public function testUserCreateFormView()
    {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $boutton = $crawler->filter('button:contains("Enregistrer")')->count();

        $this->assertEquals(1, $boutton);
    }


    public function testUserCreateValidation()
    {
        $client = $this->makeClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/create');
        $form = $crawler->selectButton('buttonUser')->form();
        $form["user_form[nom]"] = '';
        $crawler = $client->submit($form);
        $this->assertContains('Veuillez saisir un nom',
            $client->getResponse()->getContent());
    }

    public function testUserCreate_newUser()
    {

        $client = $this->makeClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/create');
        $form = $crawler->selectButton('buttonUser')->form();
        $form["user_form[nom]"] = 'SUPER TEST';
        $crawler = $client->submit($form);
        $this->assertContains('Enregistrement effectué',
            $client->getResponse()->getContent());
    }
    public function testUserCreate_existUser()
    {
        $client = $this->makeClient();
        $client->followRedirects();

        $this->loadFixtures([
            UserFixtures::class
        ]);

        $crawler = $client->request('GET', '/create');
        $form = $crawler->selectButton('buttonUser')->form();
        $form["user_form[nom]"] = 'WALKING CODER';
        $crawler = $client->submit($form);
        $this->assertContains('Le user WALKING CODER existe déjà', $client->getResponse()->getContent());

    }
}