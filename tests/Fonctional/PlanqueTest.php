<?php

namespace App\Tests\Fonctional;

use App\Entity\Planque;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class planqueTest extends WebTestCase
{
    public function testIfCreateplanqueIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('planque.new'));

        $form = $crawler->filter('form[name=planque]')->form([
            'planque[pays]' => "3",
            'planque[code]' => '5555',
            'planque[address]' => "Adresse",
            'planque[type]' => "type"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre planque a été créé avec succès !');

        $this->assertRouteSame('planque.index');
    }

    public function testIfListplanqueIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('planque.index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('planque.index');
    }

    public function testIfUpdateAnplanqueIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $planque = $entityManager->getRepository(Planque::class)->find(5);


        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('planque.edit', ['id' => $planque->getId()])
        );

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=planque]')->form([
            'planque[pays]' => "3",
            'planque[code]' => '5555',
            'planque[address]' => "Adresse",
            'planque[type]' => "type#"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre planque a été modifiée avec succès !');

        $this->assertRouteSame('planque.index');
    }

    public function testIfDeleteAnplanqueIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $planque = $entityManager->getRepository(planque::class)->find(21);

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('planque.delete', ['id' => $planque->getId()])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre planque a été supprimée avec succès !');

        $this->assertRouteSame('planque.index');
    }
}
