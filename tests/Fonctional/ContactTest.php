<?php

namespace App\Tests\Fonctional;

use App\Entity\Contact;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class contactTest extends WebTestCase
{
    public function testIfCreateContactIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('contact.new'));

        $form = $crawler->filter('form[name=contact]')->form([
            'contact[name]' => "NewContact",
            'contact[firstName]' => 'ContactName',
            'contact[dateOfBirth]' => "2023-02-02",
            'contact[codeName]' => "nom de code",
            'contact[nationalite]' => "3"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre contact a été créé avec succès !');

        $this->assertRouteSame('contact.index');
    }

    public function testIfListContactIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('contact.index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('contact.index');
    }

    public function testIfUpdateAnContactIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $contact = $entityManager->getRepository(Contact::class)->find(3);


        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('contact.edit', ['id' => $contact->getId()])
        );

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=contact]')->form([
            'contact[name]' => "NewContact#",
            'contact[firstName]' => 'ContactName#',
            'contact[dateOfBirth]' => "2023-02-02",
            'contact[codeName]' => "1515",
            'contact[nationalite]' => "3"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre contact a été modifié avec succès !');

        $this->assertRouteSame('contact.index');
    }

    public function testIfDeleteAnContactIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $contact = $entityManager->getRepository(Contact::class)->find(6);

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('contact.delete', ['id' => $contact->getId()])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre contact a été supprimé avec succès !');

        $this->assertRouteSame('contact.index');
    }
}
