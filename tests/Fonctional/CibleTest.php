<?php

namespace App\Tests\Fonctional;

use App\Entity\Cible;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class cibleTest extends WebTestCase
{
    public function testIfCreateCibleIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('cible.new'));

        $form = $crawler->filter('form[name=cible]')->form([
            'cible[name]' => "NewCible",
            'cible[firstName]' => 'CibleName',
            'cible[dateOfBirth]' => "2023-02-02",
            'cible[codeName]' => "nom de code",
            'cible[nationalite]' => "3"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre cible a été créé avec succès !');

        $this->assertRouteSame('cible.index');
    }

    public function testIfListCibleIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('cible.index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('cible.index');
    }

    public function testIfUpdateAnCibleIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $cible = $entityManager->getRepository(Cible::class)->find(3);


        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('cible.edit', ['id' => $cible->getId()])
        );

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=cible]')->form([
            'cible[name]' => "NewCible#",
            'cible[firstName]' => 'CibleName#',
            'cible[dateOfBirth]' => "2023-02-02",
            'cible[codeName]' => "1515",
            'cible[nationalite]' => "3"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre cible a été modifiée avec succès !');

        $this->assertRouteSame('cible.index');
    }

    public function testIfDeleteAnCibleIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $cible = $entityManager->getRepository(Cible::class)->find(5);

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('cible.delete', ['id' => $cible->getId()])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre cible a été supprimée avec succès !');

        $this->assertRouteSame('cible.index');
    }
}
